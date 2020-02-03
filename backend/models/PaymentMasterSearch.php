<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PaymentMaster;

/**
 * PaymentMasterSearch represents the model behind the search form of `backend\models\PaymentMaster`.
 */
class PaymentMasterSearch extends PaymentMaster
{
    /**
     * {@inheritdoc}
     */
     public $customer_name,$month_year_filter;
    public function rules()
    {
        return [
            [['payment_id', 'amount', 'booking_id'], 'integer'],
            [['date', 'type', 'mode_of_payment', 'received_by', 'received_during', 'dom', 'sendto','customer_name','month_year_filter'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params)
    {
        $query = PaymentMaster::find()->joinWith(['booking.customer']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

      /*  if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }*/
$date_format=( $this->date!='')?date('Y-m-d',strtotime( $this->date)):'';
        // grid filtering conditions
        $query->andFilterWhere([
            'payment_id' => $this->payment_id,
            'date' => $date_format,
            'dom' => $this->dom,
            'amount' => $this->amount,
           // 'booking_id' => $this->booking_id,
        ]);
      if($this->month_year_filter!='' && $this->date==''){
          $query->andWhere('DATE_FORMAT(date, "%m-%Y") = "'. $this->month_year_filter.'"');
        }
        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'mode_of_payment', $this->mode_of_payment])
            ->andFilterWhere(['like', 'received_by', $this->received_by])
            ->andFilterWhere(['like', 'received_during', $this->received_during])
            ->andFilterWhere(['like', 'customer_master.name', $this->customer_name])
            ->andFilterWhere(['like', 'sendto', $this->sendto]);
//echo $query->createCommand()->getRawSql();die;
        return $dataProvider;
    }
}
