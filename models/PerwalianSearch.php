<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Perwalian;

/**
 * PerwalianSearch represents the model behind the search form of `app\models\Perwalian`.
 */
class PerwalianSearch extends Perwalian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_dosen', 'semester', 'status'], 'integer'],
            [['nama', 'npm', 'keterangan'], 'safe'],
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
        $query = Perwalian::find();

        $this->load($params);

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_dosen' => $this->id_dosen,
            'semester' => $this->semester,
            'status' => $this->status,
        ]);

        $query->andWhere(['id_dosen' => Yii::$app->user->identity->id_dosen])
            ->andWhere(['status' => $status]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'npm', $this->npm])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

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
