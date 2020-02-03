<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BookingItem;


/**
 * BookingItemSearch represents the model behind the search form of `backend\models\BookingItem`.
 */

class BookingItemSearch extends BookingItem
{
    /**
     * {@inheritdoc}
     */
    public $item_name,$category_id,$type_id,$date,$customer_name;
    public function rules()
    {
        return [
            [['item_id', 'booking_id', 'item_no', 'product_id', 'item_type', 'item_category', 'discount', 'deposite_charge_status', 'payment_status'], 'integer'],
            [['description', 'image_name', 'pickup_date', 'picked_date', 'return_date', 'returned_date', 'item_status', 'note', 'deposite_status','item_name','category_id','type_id','customer_name'], 'safe'],
            [['net_value', 'amount', 'deposit_amount'], 'number'],
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
        $query = BookingItem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'booking_item.item_id' => $this->item_id,
            'booking_item.booking_id' => $this->booking_id,
            'booking_item.item_no' => $this->item_no,
            'booking_item.product_id' => $this->product_id,
            'booking_item.net_value' => $this->net_value,
            'booking_item.item_type' => $this->item_type,
            'booking_item.item_category' => $this->item_category,
            'booking_item.amount' => $this->amount,
            'booking_item.discount' => $this->discount,
            'booking_item.deposit_amount' => $this->deposit_amount,
            'booking_item.deposite_charge_status' => $this->deposite_charge_status,
            'booking_item.pickup_date' => $this->pickup_date,
            'booking_item.picked_date' => $this->picked_date,
            'booking_item.return_date' => $this->return_date,
            'booking_item.returned_date' => $this->returned_date,
            'booking_item.payment_status' => $this->payment_status,
        ]);

        $query->andFilterWhere(['like', 'booking_item.description', $this->description])
            ->andFilterWhere(['like', 'booking_item.image_name', $this->image_name])
            ->andFilterWhere(['like', 'booking_item.item_status', $this->item_status])
            ->andFilterWhere(['like', 'booking_item.note', $this->note])
            ->andFilterWhere(['like', 'booking_item.deposite_status', $this->deposite_status]);

        return $dataProvider;
    }
     public function searchItem($params)
    {
        $query = BookingItem::find()->joinWith(['booking.customer','item']);
       //$date=date('m-Y');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'booking_item.item_id' => $this->item_id,
            'booking_item.booking_id' => $this->booking_id,
            'booking_item.item_no' => $this->item_no,
            'booking_item.product_id' => $this->product_id,
            'booking_item.net_value' => $this->net_value,
            'booking_item.item_type' => $this->item_type,
            'booking_item.item_category' => $this->item_category,
            'booking_item.amount' => $this->amount,
            'booking_item.discount' => $this->discount,
            'booking_item.deposit_amount' => $this->deposit_amount,
            'booking_item.deposite_charge_status' => $this->deposite_charge_status,
            'booking_item.pickup_date' => $this->pickup_date,
            'booking_item.picked_date' => $this->picked_date,
            'booking_item.return_date' => $this->return_date,
            'booking_item.returned_date' => $this->returned_date,
            'booking_item.payment_status' => $this->payment_status,
            'item_master.category_id' => $this->category_id,
            'item_master.type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'booking_item.description', $this->description])
            ->andFilterWhere(['like', 'booking_item.image_name', $this->image_name])
            ->andFilterWhere(['like', 'booking_item.item_status', $this->item_status])
            ->andFilterWhere(['like', 'booking_item.note', $this->note])
            ->andFilterWhere(['like', 'customer_master.name', $this->customer_name])
            ->andFilterWhere(['like', 'item_master.name', $this->item_name])
            ->andFilterWhere(['like', 'booking_item.deposite_status', $this->deposite_status]);
     $query->andWhere(['booking_header.order_status'=>array('Open','Closed','Cancelled')])->andWhere('DATE_FORMAT(booking_header.pickup_date, "%m-%Y") = "'. $this->date.'"');
        return $dataProvider;
    }

}
