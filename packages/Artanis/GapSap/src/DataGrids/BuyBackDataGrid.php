<?php

namespace Artanis\GapSap\DataGrids;

use Artanis\GapSap\Models\GoldSilverHistory;
use Webkul\Ui\DataGrid\DataGrid;
use DB;

/**
 * OrderRefundDataGrid Class
 *
 * @author Prashant Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class BuyBackDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        // $queryBuilder = DB::table('refunds')
        //         ->select('refunds.id', 'orders.increment_id', 'refunds.state', 'refunds.base_grand_total', 'refunds.created_at')
        //         ->leftJoin('orders', 'refunds.order_id', '=', 'orders.id')
        //         ->leftJoin('order_address as order_address_billing', function($leftJoin) {
        //             $leftJoin->on('order_address_billing.order_id', '=', 'orders.id')
        //                 ->where('order_address_billing.address_type', 'billing');
        //         })
        //         ->addSelect(DB::raw('CONCAT(order_address_billing.first_name, " ", order_address_billing.last_name) as billed_to'));

        // $this->addFilter('billed_to', DB::raw('CONCAT(order_address_billing.first_name, " ", order_address_billing.last_name)'));
        // $this->addFilter('id', 'refunds.id');
        // $this->addFilter('increment_id', 'orders.increment_id');
        // $this->addFilter('state', 'refunds.state');
        // $this->addFilter('base_grand_total', 'refunds.base_grand_total');
        // $this->addFilter('created_at', 'refunds.created_at');

        // $this->setQueryBuilder($queryBuilder);

        $queryBuilder = DB::table('gold_silver_history')
                ->leftJoin('customers', function($leftJoin) {
                    $leftJoin->on('customers.id', '=', 'gold_silver_history.customer_id');
                })
                ->addSelect('gold_silver_history.increment_id' ,'gold_silver_history.id', 'gold_silver_history.product_type', 'gold_silver_history.current_price_per_gram', 'gold_silver_history.current_price_datetime', 'gold_silver_history.amount', 'gold_silver_history.quantity', 'gold_silver_history.payment_method', 'gold_silver_history.payment_on', 'gold_silver_history.status', 'gold_silver_history.payment_attachment')
                ->addSelect(DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_full_name'))
                ->where('activity', 'buyback')
                ->where('customer_id', auth()->guard('customer')->user()->id);;

        $this->addFilter('increment_id', 'gold_silver_history.increment_id');
        $this->addFilter('customer_full_name', DB::raw('CONCAT(customers.first_name, " ", customers.last_name)'));

        $this->setQueryBuilder($queryBuilder);

    }

    public function addColumns()
    {
        // $this->addColumn([
        //     'index' => 'id',
        //     'label' => 'No',
        //     'type' => 'number',
        //     'searchable' => false,
        //     'sortable' => false,
        //     'filterable' => false
        // ]);

        $this->addColumn([
            'index' => 'increment_id',
            'label' => 'Id',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'gold_silver_history.product_type',
            'label' => 'Type',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'closure' => true,
            'filterable' => true,
            'wrapper' => function ($value) {
                    return ucfirst($value->product_type);
            }
        ]);

        // $this->addColumn([
        //     'index' => 'customer_full_name',
        //     'label' => 'Customer Name',
        //     'type' => 'string',
        //     'searchable' => true,
        //     'sortable' => true,
        //     'closure' => true,
        //     'filterable' => true
        // ]);

        // $this->addColumn([
        //     'index' => 'amount',
        //     'label' => 'Purchase Amount',
        //     'type' => 'price',
        //     'searchable' => true,
        //     'sortable' => true,
        //     'filterable' => true
        // ]);

        // $this->addColumn([
        //     'index' => 'quantity',
        //     'label' => 'Purchase Quantity',
        //     'type' => 'float',
        //     'searchable' => true,
        //     'sortable' => true,
        //     'filterable' => true,
        //     'wrapper' => function ($value) {
        //         return $value->quantity.' (g)';
        //     }
        // ]);

        // $this->addColumn([
        //     'index' => 'current_price_per_gram',
        //     'label' => 'Current Price',
        //     'type' => 'price',
        //     'searchable' => true,
        //     'sortable' => true,
        //     'filterable' => true
        // ]);

        // $this->addColumn([
        //     'index' => 'current_price_datetime',
        //     'label' => 'Price Updated',
        //     'type' => 'string',
        //     'searchable' => true,
        //     'sortable' => true,
        //     'filterable' => true
        // ]);

        $this->addColumn([
            'index' => 'gold_silver_history.payment_on',
            'label' => 'Buyback On',
            'type' => 'date',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        // $this->addColumn([
        //     'index' => 'gold_silver_history.payment_attachment',
        //     'label' => 'Attachement',
        //     'type' => 'string',
        //     'searchable' => true,
        //     'closure' => true,
        //     'sortable' => true,
        //     'filterable' => true,
        //     'wrapper' => function ($value) {
        //         if (!$value->payment_attachment) {
        //             return 'Null';
        //         }
        //         else
        //             return '<a href="http://127.0.0.1:8000/storage/' .$value->payment_attachment. '" target="_blank"> <img src="http://127.0.0.1:8000/storage/'.$value->payment_attachment.'" alt="Smiley face" height="50" width="50"> </a>';
        //     }
        // ]);

        // $this->addColumn([
        //     'index' => 'gold_silver_history.payment_method',
        //     'label' => 'Purchase Type',
        //     'type' => 'string',
        //     'searchable' => true,
        //     'sortable' => true,
        //     'filterable' => true,
        //     'wrapper' => function ($value) {
        //         if ($value->payment_method == 'fpx')
        //             return 'FPX';
        //         else if ($value->payment_method == 'bankin')
        //             return 'Bankin';
        //     }
        // ]);

        $this->addColumn([
            'index' => 'gold_silver_history.status',
            'label' => 'Status',
            'type' => 'string',
            'sortable' => true,
            'searchable' => true,
            'closure' => true,
            'filterable' => true,
            'wrapper' => function ($value) {
                if ($value->status == 'processing')
                    return '<span class="badge badge-md badge-success">Processing</span>';
                else if ($value->status == 'completed')
                    return '<span class="badge badge-md badge-success">Completed</span>';
                else if ($value->status == "canceled")
                    return '<span class="badge badge-md badge-danger">Canceled</span>';
                else if ($value->status == "closed")
                    return '<span class="badge badge-md badge-info">Closed</span>';
                else if ($value->status == "paid")
                    return '<span class="badge badge-md badge-warning">Paid</span>';
                else if ($value->status == "pending_payment")
                    return '<span class="badge badge-md badge-warning">Pending Payment</span>';
                else if ($value->status == "fraud")
                    return '<span class="badge badge-md badge-danger">Fraud</span>';
            }
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'title' => 'Purchase View',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'gapsap.account.buyback.view',
            'icon' => 'icon eye-icon'
        ]);
    }
}
