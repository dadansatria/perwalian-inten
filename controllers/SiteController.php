<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\ContactForm;
use PhpOffice\PhpWord\Shared\Converter;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            if (User::isAdmin()) {
                return $this->redirect(['mahasiswa/index']);
            } elseif(User::isDosen()){
                return $this->redirect(['perwalian/index','status'=>2]);
            } elseif(User::isMahasiswa()){
                return $this->redirect(['mahasiswa/rekap']);
            }
        }
        else{
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = '//main-login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTes()
    {
        return $this->render('tes');
    }


    public function actionExportExcelAnalisiRisiko()
    {
        $PHPExcel = new \PHPExcel();

        $PHPExcel->setActiveSheetIndex();

        $sheet = $PHPExcel->getActiveSheet();

        $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
        $sheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $setBorderArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $sheet->getStyle('A1:I2')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getStyle('A3:I3')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'ff0000')
                )
            )
        );

        $PHPExcel->getActiveSheet()->getStyle('A3:I3')->
            applyFromArray(
                array('font' => array
                    ('color' => array('rgb' => 'fffff')
                        )
                    )
                );
        
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(7);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('F')->setWidth(7);
        $sheet->getColumnDimension('G')->setWidth(10);
        $sheet->getColumnDimension('H')->setWidth(7);
        $sheet->getColumnDimension('I')->setWidth(10);

        $sheet->setCellValue('A1', 'NO. REGISTER');
        $sheet->setCellValue('B2', 'DESKRIPSI RISIKO');
        $sheet->setCellValue('C2', 'DAMPAK');
        $sheet->setCellValue('D2', 'TINGKAT KEMUNGKINAN');
        $sheet->setCellValue('E2', 'SKALA DAMPAK');
        $sheet->setCellValue('F2', 'SKALA DAMPAK');
        $sheet->setCellValue('H2', 'LEVER RISIKO');

        $PHPExcel->getActiveSheet()->setCellValue('A1', 'NO. REGISTER');
        $PHPExcel->getActiveSheet()->setCellValue('B1', 'RISIKO (INHEREN) YANG TERIDENTIFIKASI');

        $PHPExcel->getActiveSheet()->mergeCells('A1:A2');
        $PHPExcel->getActiveSheet()->mergeCells('B1:I1');
        $PHPExcel->getActiveSheet()->mergeCells('D2:E2');
        $PHPExcel->getActiveSheet()->mergeCells('F2:G2');
        $PHPExcel->getActiveSheet()->mergeCells('H2:I2');
        $PHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(40);
        $PHPExcel->getActiveSheet()->freezePane('A4');


        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('B2:I2')->getFont()->setBold(true);
        $sheet->getStyle('A1:I3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D4:I4')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $row = 2;

            $row++;
            $sheet->setCellValue('A' . $row, '1');
            $sheet->setCellValue('B' . $row, '4');
            $sheet->setCellValue('C' . $row, '6');
            $sheet->setCellValue('D' . $row, '8');
            $sheet->setCellValue('E' . $row, '9');
            $sheet->setCellValue('F' . $row, '10');
            $sheet->setCellValue('G' . $row, '11');
            $sheet->setCellValue('H' . $row, '12');
            $sheet->setCellValue('I' . $row, '13');

        $sheet->getStyle('A4:I' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D4:I' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E4:I' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A1:I' . $row)->applyFromArray($setBorderArray);

        $path = 'exports/';
        $filename = 'Export Analisis Risiko '.date('Y-m-d').'.xlsx';
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save($path.$filename);
        return Yii::$app->getResponse()->redirect($path.$filename);
    }

    public function actionExportExcelKontrolEksisting()
    {
        $PHPExcel = new \PHPExcel();

        $PHPExcel->setActiveSheetIndex();

        $sheet = $PHPExcel->getActiveSheet();

        $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
        $sheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $setBorderArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $sheet->getStyle('A1:K2')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getStyle('D3:F3')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getStyle('H3')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getStyle('A3:C3')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'ff0000')
                )
            )
        );

        $sheet->getStyle('G3')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'ff0000')
                )
            )
        );

        $sheet->getStyle('I3:K3')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'ff0000')
                )
            )
        );

        $PHPExcel->getActiveSheet()
        ->getStyle('A3:C3')
        ->applyFromArray(
                array('font' => array
                    ('color' => array('rgb' => 'fffff')
                        )
                    )
                );

        $PHPExcel->getActiveSheet()
        ->getStyle('G3')
        ->applyFromArray(
                array('font' => array
                    ('color' => array('rgb' => 'fffff')
                        )
                    )
                );

        $PHPExcel->getActiveSheet()
        ->getStyle('I3:K3')
        ->applyFromArray(
                array('font' => array
                    ('color' => array('rgb' => 'fffff')
                        )
                    )
                );
        
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(8);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(8);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(8);
        $sheet->getColumnDimension('K')->setWidth(15);

        $sheet->setCellValue('A1', 'NO. REGISTER');
        $sheet->setCellValue('B2', 'DESKRIPSI RISIKO');
        $sheet->setCellValue('C2', 'LEVEL RESIKO');
        $sheet->setCellValue('D2', 'THDP KEMUNGKINAN (PENCEGAHAN)');
        $sheet->setCellValue('E2', 'THDP DAMPAK (PEMULIHAN)');
        $sheet->setCellValue('F2', 'TINGKAT KEMUNGKINAN');
        $sheet->setCellValue('H2', 'SKALA DAMPAK');
        $sheet->setCellValue('J2', 'LEVEL RISIKO');

        $PHPExcel->getActiveSheet()->setCellValue('A1', 'NO. REGISTER');
        $PHPExcel->getActiveSheet()->setCellValue('B1', 'RISIKO (INHEREN) YANG TERIDENTIFIKASI');
        $PHPExcel->getActiveSheet()->setCellValue('D1', 'KONTROL YG TELAH ADA (EKSISTING)');
        $PHPExcel->getActiveSheet()->setCellValue('F1', 'LEVEL RISIKO PASCA KONTROL EKSISTING (CONTROLLED RISK) *');

        $PHPExcel->getActiveSheet()->mergeCells('A1:A2');
        $PHPExcel->getActiveSheet()->mergeCells('B1:C1');
        $PHPExcel->getActiveSheet()->mergeCells('D1:E1');
        $PHPExcel->getActiveSheet()->mergeCells('F2:G2');
        $PHPExcel->getActiveSheet()->mergeCells('F1:K1');
        $PHPExcel->getActiveSheet()->mergeCells('H2:I2');
        $PHPExcel->getActiveSheet()->mergeCells('J2:K2');
        $PHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(40);
        $PHPExcel->getActiveSheet()->freezePane('A4');


        $sheet->getStyle('A1:K1')->getFont()->setBold(true);
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);
        $sheet->getStyle('B2:K2')->getFont()->setBold(true);
        $sheet->getStyle('A1:K3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D4:K4')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $row = 2;

            $row++;
            $sheet->setCellValue('A' . $row, '1');
            $sheet->setCellValue('B' . $row, '4');
            $sheet->setCellValue('C' . $row, '12/13');
            $sheet->setCellValue('D' . $row, '14');
            $sheet->setCellValue('E' . $row, '15');
            $sheet->setCellValue('F' . $row, '16');
            $sheet->setCellValue('G' . $row, '17');
            $sheet->setCellValue('H' . $row, '18');
            $sheet->setCellValue('I' . $row, '19');
            $sheet->setCellValue('J' . $row, '20');
            $sheet->setCellValue('K' . $row, '21');

        $sheet->getStyle('A4:K' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D4:K' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E4:K' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A1:K' . $row)->applyFromArray($setBorderArray);

        $path = 'exports/';
        $filename = 'Export Kontrol Eksisting '.date('Y-m-d').'.xlsx';
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save($path.$filename);
        return Yii::$app->getResponse()->redirect($path.$filename);
    }

    public function actionExportExcelKriteriaAnalisis()
    {
        $PHPExcel = new \PHPExcel();

        $PHPExcel->setActiveSheetIndex();

        $sheet = $PHPExcel->getActiveSheet();

        $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
        $sheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $setBorderArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $setNoBorderArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_NONE
                )
            )
        );

        $sheet->getStyle('H6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getStyle('F6:G11')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getStyle('L6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getStyle('J6:K11')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getStyle('B11')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '0739c7')
                )
            )
        );

        $PHPExcel->getActiveSheet()->getStyle('B11')->
            applyFromArray(
                array('font' => array
                    ('color' => array('rgb' => 'fffff')
                        )
                    )
                );

        $PHPExcel->getActiveSheet()->getStyle('B8:D9')->
            applyFromArray(
                array('font' => array
                    ('color' => array('rgb' => 'ea2020')
                        )
                    )
                );

        $PHPExcel->getActiveSheet()->getStyle('F6:H6')->
            applyFromArray(
                array('font' => array
                    ('color' => array('rgb' => 'ea2020')
                        )
                    )
                );

        $PHPExcel->getActiveSheet()->getStyle('J6:L6')->
            applyFromArray(
                array('font' => array
                    ('color' => array('rgb' => 'ea2020')
                        )
                    )
                );
        
        $sheet->getColumnDimension('A')->setWidth(1);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(3);
        $sheet->getColumnDimension('F')->setWidth(5);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(55);
        $sheet->getColumnDimension('I')->setWidth(3);
        $sheet->getColumnDimension('J')->setWidth(5);
        $sheet->getColumnDimension('K')->setWidth(18);
        $sheet->getColumnDimension('L')->setWidth(50);

        $sheet->setCellValue('B1', 'Penetapan KRITERIA Tingkat Kemungkinan & Dampak beserta ANALISIS Risiko');
        $sheet->setCellValue('B3', 'UNIT INDUK : Inspektorat Kabupaten - Sorong');
        $sheet->setCellValue('B4', 'NAMA KEGIATAN : Meningkatkan Kompetensi SDM Pengawasan untuk Menunjang Terimplementasinya SPIP Kab Sorong pada Inspektorat Kab Sorong Tahun 2015 - 2018');
        $sheet->setCellValue('B7', 'Deskripsi Risiko :');
        $sheet->setCellValue('B8', 'Inspektorat tidak memiliki kewenangan dalam menentukan kriteria SDM yang dibutuhkan');
        $sheet->setCellValue('B10', 'Hasil Analisis :');
        $sheet->setCellValue('C10', 'Tingkat Kemungkinan :');
        $sheet->setCellValue('B11', 'C.4');
        $sheet->setCellValue('C11', 'Skala Dampak');
        $sheet->setCellValue('F6', 'KEMUNGKINAN');
        $sheet->setCellValue('H6', 'KRITERIA');
        $sheet->setCellValue('J6', 'DAMPAK');
        $sheet->setCellValue('L6', 'KRITERIA');

        $PHPExcel->getActiveSheet()->mergeCells('B1:D1');
        $PHPExcel->getActiveSheet()->mergeCells('B3:C3');
        $PHPExcel->getActiveSheet()->mergeCells('B4:D4');
        $PHPExcel->getActiveSheet()->mergeCells('B7:C7');
        $PHPExcel->getActiveSheet()->mergeCells('B8:D9');
        $PHPExcel->getActiveSheet()->mergeCells('F6:G6');
        $PHPExcel->getActiveSheet()->mergeCells('J6:K6');
        $PHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(25);
        $PHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(25);
        $PHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(20);
        $PHPExcel->getActiveSheet()->getRowDimension(9)->setRowHeight(20);
        $PHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(25);
        $PHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(25);

        /*$sheet->getStyle('B7')->getFont()->setBold(true);*/
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('F7:G11')->getFont()->setBold(true);
        $sheet->getStyle('F6:H6')->getFont()->setBold(true);
        $sheet->getStyle('J6:L6')->getFont()->setBold(true);
        $sheet->getStyle('J7:K11')->getFont()->setBold(true);
        $sheet->getStyle('B7')->getFont()->setBold(true);
        $sheet->getStyle('B10')->getFont()->setBold(true);
        $sheet->getStyle('C10:C11')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('B11')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D7:D11')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F7:F11')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F6:H6')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('J6:L6')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('J7:J11')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $row = 5;

        $sheet->setCellValue('D7','1');
        $sheet->setCellValue('D10','C');
        $sheet->setCellValue('D11','4');

        $sheet->setCellValue('F7','A');
        $sheet->setCellValue('F8','B');
        $sheet->setCellValue('F9','C');
        $sheet->setCellValue('F10','D');
        $sheet->setCellValue('F11','E');

        $sheet->setCellValue('G7','Sangat Kecil');
        $sheet->setCellValue('G8','Kecil');
        $sheet->setCellValue('G9','Sedang');
        $sheet->setCellValue('G10','Besar');
        $sheet->setCellValue('G11','Sangat Besar');

        $sheet->setCellValue('H7','Dipastikan akan sangat tidak mungkin terjadi');
        $sheet->setCellValue('H8','Kemungkinan kecil dapat terjadi');
        $sheet->setCellValue('H9','Sama kemungkinan antara terjadi atau tidak terjadi');
        $sheet->setCellValue('H10','Kemungkinan besar dapat terjadi');
        $sheet->setCellValue('H11','Dipastikan akan sangat mungkin terjadi');

        $sheet->setCellValue('J7','1');
        $sheet->setCellValue('J8','2');
        $sheet->setCellValue('J9','3');
        $sheet->setCellValue('J10','4');
        $sheet->setCellValue('J11','5');

        $sheet->setCellValue('K7','Tidak Signifikan');
        $sheet->setCellValue('K8','Minor');
        $sheet->setCellValue('K9','Medium');
        $sheet->setCellValue('K10','Signifikan');
        $sheet->setCellValue('K11','Malapetaka');

        $sheet->setCellValue('L11','SAP tidak dapat dioperasikan dengan benar');


        /*$sheet->getStyle('A4:I' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D4:I' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E4:I' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/


        $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B8:D9')->applyFromArray($setBorderArray);
        $sheet->getStyle('D7:D11')->applyFromArray($setBorderArray);
        $sheet->getStyle('B11')->applyFromArray($setBorderArray);
        $sheet->getStyle('F7:H11')->applyFromArray($setBorderArray);
        $sheet->getStyle('H6')->applyFromArray($setBorderArray);
        $sheet->getStyle('F6:H11')->applyFromArray($setBorderArray);
        $sheet->getStyle('J6:L11')->applyFromArray($setBorderArray);
        $sheet->getStyle('A1:I' . $row)->applyFromArray($setNoBorderArray);

        $path = 'exports/';
        $filename = 'Export Kriteria & Analisis '.date('Y-m-d').'.xlsx';
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save($path.$filename);
        return Yii::$app->getResponse()->redirect($path.$filename);
    }

    public function actionExportExcelDisplayOutput()
    {
        $PHPExcel = new \PHPExcel();

        $PHPExcel->setActiveSheetIndex();

        $sheet = $PHPExcel->getActiveSheet();

        $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
        $sheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $setBorderArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );  

        $sheet->getStyle('B4:H6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getColumnDimension('A')->setWidth(2);
        $sheet->getColumnDimension('B')->setWidth(8);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(15);

        $PHPExcel->getActiveSheet()->setCellValue('B1', 'Kajian Risiko  Meningkatkan Kompetensi SDM Pengawasan untuk Menunjang Terimplementasinya SPIP Kab Sorong pada Inspektorat Kab Sorong  Tahun 2015 -2018');
        $PHPExcel->getActiveSheet()->setCellValue('B3', 'UNIT INDUK : Inspektorat Kabupaten - Sorong');
        $PHPExcel->getActiveSheet()->setCellValue('B4', 'NO. REG.');
        $PHPExcel->getActiveSheet()->setCellValue('C4', 'IDENTIFIKASI RISIKO (INHEREN)');
        $PHPExcel->getActiveSheet()->setCellValue('C5', 'RISIKO');
        $PHPExcel->getActiveSheet()->setCellValue('D5', 'PENYEBAB');
        $PHPExcel->getActiveSheet()->setCellValue('E5', 'DAMPAK');
        $PHPExcel->getActiveSheet()->setCellValue('F5', 'LEVEL RISIKO');
        $PHPExcel->getActiveSheet()->setCellValue('G4', 'RENCANA PENANGANAN (MITIGASI)');
        $PHPExcel->getActiveSheet()->setCellValue('G5', 'PROGRAM MITIGASI');
        $PHPExcel->getActiveSheet()->setCellValue('H5', 'PENANGGUNG JAWAB');

        $PHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
        $PHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(12);
        $PHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(30);

        $PHPExcel->getActiveSheet()->mergeCells('B1:H1');
        $PHPExcel->getActiveSheet()->mergeCells('B3:D3');
        $PHPExcel->getActiveSheet()->mergeCells('B4:B5');
        $PHPExcel->getActiveSheet()->mergeCells('C4:F4');
        $PHPExcel->getActiveSheet()->mergeCells('G4:H4');
        $PHPExcel->getActiveSheet()->freezePane('A7');

        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('B4:H6')->getFont()->setBold(true);

        $sheet->getStyle('B4:H6')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B7')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('B6', '1');
        $sheet->setCellValue('C6', '2');
        $sheet->setCellValue('D6', '3');
        $sheet->setCellValue('E6', '4');
        $sheet->setCellValue('F6', '5');
        $sheet->setCellValue('G6', '6');
        $sheet->setCellValue('H6', '7');

        $sheet->setCellValue('B7', '1');
        $sheet->setCellValue('C7', ' Inspektorat tidak memiliki kewenangan dalam menentukan kriteria SDM yang dibutuhkan');
        $sheet->setCellValue('D7', ' Formasi yang tersedia tidak secara spesifik menyebutkan kebutuhan untuk tenaga pemeriksa');
        $sheet->setCellValue('E7', ' Kemampuan dasar belum dapat digunakan untuk melakukan tugas-tugas pemeriksaan');
        $sheet->setCellValue('F7', 'E.4 / EKSTREM');
        $sheet->setCellValue('G7', 'Perlunya pelatihan SAP untuk pemegang role baru');
        $sheet->setCellValue('H7', ' KDIVSDM, KDIVORG, GM, MANSDM');

        $row = 6;

        /*$sheet->setCellValue('D7','1');
        $sheet->setCellValue('D10','C');
        $sheet->setCellValue('D11','4');
        $sheet->setCellValue('F7','A');
        $sheet->setCellValue('F8','B');
        $sheet->setCellValue('F9','C');*/

        /*$sheet->getStyle('A4:G5')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/
        $sheet->getStyle('B4:A' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        /*$sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

        $sheet->getStyle('B4:H' . $row)->applyFromArray($setBorderArray);
        $sheet->getStyle('B7:H7')->applyFromArray($setBorderArray);

        $path = 'exports/';
        $filename = 'Export Displays Output '.date('Y-m-d H:i:s').'.xlsx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save("php://output");
    }

    public function actionExportExcelRiskRegister()
    {
        $PHPExcel = new \PHPExcel();

        $PHPExcel->setActiveSheetIndex();

        $sheet = $PHPExcel->getActiveSheet();

        $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
        $sheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $setBorderArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );  

        $sheet->getStyle('B4:V6')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getColumnDimension('A')->setWidth(2);
        $sheet->getColumnDimension('B')->setWidth(6);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(15);
        $sheet->getColumnDimension('K')->setWidth(20);
        $sheet->getColumnDimension('L')->setWidth(20);
        $sheet->getColumnDimension('M')->setWidth(20);
        $sheet->getColumnDimension('N')->setWidth(13);
        $sheet->getColumnDimension('O')->setWidth(13);
        $sheet->getColumnDimension('P')->setWidth(13);
        $sheet->getColumnDimension('Q')->setWidth(13);
        $sheet->getColumnDimension('R')->setWidth(13);
        $sheet->getColumnDimension('S')->setWidth(13);
        $sheet->getColumnDimension('T')->setWidth(13);
        $sheet->getColumnDimension('U')->setWidth(13);
        $sheet->getColumnDimension('V')->setWidth(15);

        $PHPExcel->getActiveSheet()->setCellValue('B1', 'UNIT INDUK : Inspektorat Kabupaten - Sorong');
        $PHPExcel->getActiveSheet()->setCellValue('B2', 'NAMA KEGIATAN : Meningkatkan Kompetensi SDM Pengawasan Untuk Menunjang Terimplementasinya SPIP Kab Sorong Pada Inspektorat Kab Sorong Tahun 2015-2018');
        $PHPExcel->getActiveSheet()->setCellValue('B4', 'NO. REG.');
        $PHPExcel->getActiveSheet()->setCellValue('C4', 'IDENTIFIKASI RISIKO (INHEREN)');
        $PHPExcel->getActiveSheet()->setCellValue('C5', 'RISIKO');
        $PHPExcel->getActiveSheet()->setCellValue('D5', 'PENYEBAB');
        $PHPExcel->getActiveSheet()->setCellValue('E5', 'DAMPAK');
        $PHPExcel->getActiveSheet()->setCellValue('F5', 'TINGKAT KEMUNGKINAN');
        $PHPExcel->getActiveSheet()->setCellValue('G5', 'SKALA DAMPAK');
        $PHPExcel->getActiveSheet()->setCellValue('H5', 'LEVEL RISIKO');
        $PHPExcel->getActiveSheet()->setCellValue('I4', 'KONTROL YANG TELAH ADA (EKSISTING)');
        $PHPExcel->getActiveSheet()->setCellValue('I5', 'PENCEGAHAN');
        $PHPExcel->getActiveSheet()->setCellValue('J5', 'PEMULIHAN');
        $PHPExcel->getActiveSheet()->setCellValue('K4', 'RISIKO PASCA KONTROL EKSISTING (CONTROLLED RISK)');
        $PHPExcel->getActiveSheet()->setCellValue('K5', 'TINGKAT KEMUNGKINAN');
        $PHPExcel->getActiveSheet()->setCellValue('L5', 'SKALA DAMPAK');
        $PHPExcel->getActiveSheet()->setCellValue('M5', 'LEVEL RESIKO');
        $PHPExcel->getActiveSheet()->setCellValue('N4', 'PENANGANAN (MITIGASI) RISIKO');
        $PHPExcel->getActiveSheet()->setCellValue('N5', 'PROGRAM MITIGASI');
        $PHPExcel->getActiveSheet()->setCellValue('O5', 'BIAYA MITIGASI');
        $PHPExcel->getActiveSheet()->setCellValue('P5', '% RATIO BIAYA THDP DAMPAK');
        $PHPExcel->getActiveSheet()->setCellValue('Q5', 'PENANGGUNG JAWAB MITIGASI');
        $PHPExcel->getActiveSheet()->setCellValue('R5', 'WAKTU PELAKSANAAN');
        $PHPExcel->getActiveSheet()->setCellValue('S4', 'RISIKO RESIDUAL (PASCA MITIGASI)');
        $PHPExcel->getActiveSheet()->setCellValue('S5', 'TINGKAT KEMUNGKINAN');
        $PHPExcel->getActiveSheet()->setCellValue('T5', 'SKALA DAMPAK');
        $PHPExcel->getActiveSheet()->setCellValue('U5', 'LEVEL RESIKO');
        $PHPExcel->getActiveSheet()->setCellValue('V4', 'MEKANISME PEMANTAUAN');


        $PHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
        $PHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(15);
        $PHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(40);
        $PHPExcel->getActiveSheet()->mergeCells('B1:D1');
        $PHPExcel->getActiveSheet()->mergeCells('B2:F2');

        $PHPExcel->getActiveSheet()->mergeCells('B4:B5');
        $PHPExcel->getActiveSheet()->mergeCells('C4:H4');
        $PHPExcel->getActiveSheet()->mergeCells('I4:J4');
        $PHPExcel->getActiveSheet()->mergeCells('K4:M4');
        $PHPExcel->getActiveSheet()->mergeCells('N4:R4');
        $PHPExcel->getActiveSheet()->mergeCells('S4:U4');
        $PHPExcel->getActiveSheet()->mergeCells('V4:V5');

        $sheet->getStyle('B4:V6')->getFont()->setBold(true);
        $sheet->getStyle('B4:V6')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        /*$sheet->getStyle('B4:H6')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

        /*$sheet->setCellValue('B6', '1');*/

        $row = 6;

        $sheet->setCellValue('B6','1');
        $sheet->setCellValue('C6','2');
        $sheet->setCellValue('D6','3');
        $sheet->setCellValue('E6','4');
        $sheet->setCellValue('F6','5');
        $sheet->setCellValue('G6','6');
        $sheet->setCellValue('H6','7');
        $sheet->setCellValue('I6','8');
        $sheet->setCellValue('J6','9');
        $sheet->setCellValue('K6','10');
        $sheet->setCellValue('L6','11');
        $sheet->setCellValue('M6','12');
        $sheet->setCellValue('N6','13');
        $sheet->setCellValue('O6','14');
        $sheet->setCellValue('P6','15');
        $sheet->setCellValue('Q6','16');
        $sheet->setCellValue('R6','17');
        $sheet->setCellValue('S6','18');
        $sheet->setCellValue('T6','19');
        $sheet->setCellValue('U6','20');
        $sheet->setCellValue('V6','21');



        /*$sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

        $sheet->getStyle('B4:V6')->applyFromArray($setBorderArray);

        $path = 'exports/';
        $filename = 'Export Risk Register '.date('Y-m-d H:i:s').'.xlsx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save("php://output");
    }

    public function actionExportExcelPemantauan()
    {
        $PHPExcel = new \PHPExcel();

        $PHPExcel->setActiveSheetIndex();

        $sheet = $PHPExcel->getActiveSheet();

        $sheet->getDefaultStyle()->getAlignment()->setWrapText(true);
        $sheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $setBorderArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $sheet->getStyle('A1:F1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getStyle('E2:F2')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'f5f5f5')
                )
            )
        );

        $sheet->getStyle('A2:D2')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'c30e0e')
                )
            )
        );

        $PHPExcel->getActiveSheet()
        ->getStyle('A2:D2')
        ->applyFromArray(
                array('font' => array
                    ('color' => array('rgb' => 'fffff')
                        )
                    )
                );
        
        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(35);
        $sheet->getColumnDimension('E')->setWidth(40);
        $sheet->getColumnDimension('F')->setWidth(25);

        $sheet->setCellValue('A1', 'NO. REG');
        $sheet->setCellValue('B1', 'RISIKO');
        $sheet->setCellValue('C1', 'LEVEL RESIKO (Controlled Risk)');
        $sheet->setCellValue('D1', 'RENCANA MITIGASI');
        $sheet->setCellValue('E1', 'REALISASI PELAKSANAAN MITIGASI');
        $sheet->setCellValue('F1', 'KETERANGAN');

        $PHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
        $PHPExcel->getActiveSheet()->freezePane('A3');


        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $row = 1;

            $row++;
            $sheet->setCellValue('A' . $row, '1');
            $sheet->setCellValue('B' . $row, '2');
            $sheet->setCellValue('C' . $row, '3');
            $sheet->setCellValue('D' . $row, '4');
            $sheet->setCellValue('E' . $row, '5');
            $sheet->setCellValue('F' . $row, '6');

            $sheet->setCellValue('A3', '1');
            $sheet->setCellValue('B3', ' Inspektorat tidak memiliki kewenangan dalam menentukan kriteria SDM yang dibutuhkan');
            $sheet->setCellValue('C3', 'E.4 / EKSTREM');
            $sheet->setCellValue('D3', 'Perlunya pelatihan SAP untuk pemegang role baru');
            $sheet->setCellValue('E3', '');
            $sheet->setCellValue('F3', '');


        $sheet->getStyle('A4:K' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D4:K' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E4:K' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A1:F' . $row)->applyFromArray($setBorderArray);
        $sheet->getStyle('A3:F3')->applyFromArray($setBorderArray);

        $path = 'exports/';
        $filename = 'Export Pemantauan '.date('Y-m-d His').'.xlsx';
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save($path.$filename);
        return Yii::$app->getResponse()->redirect($path.$filename);
    }

}
