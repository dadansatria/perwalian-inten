<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PerwalianMatkul;

/**
 * PerwalianMatkulSearch represents the model behind the search form of `app\models\PerwalianMatkul`.
 */
class PerwalianMatkulSearch extends PerwalianMatkul
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_matkul', 'id_perwalian', 'status'], 'integer'],
            [['nilai'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */

    public function getQuerySearch($params,$status)
    {
        $query = PerwalianMatkul::find();

        $this->load($params);

        $query->joinWith('matkul')
            ->andWhere(['matkul.id_dosen' => Yii::$app->user->identity->id_dosen])
            ->andWhere(['status' => $status]);
        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_matkul' => $this->id_matkul,
            'id_perwalian' => $this->id_perwalian,
            'status' => $this->status,
        ]);


        $query->andFilterWhere(['like', 'nilai', $this->nilai]);

        return $query;
    }
    
    public function search($params,$status)
    {
        $query = $this->getQuerySearch($params,$status);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);        

        return $dataProvider;
    }


}
