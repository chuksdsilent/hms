@extends('partials.client')
@section('title', 'Test Details')
@section('content')
<div class="custom my-4">
    <div class="tests">
        <div class="card">
            <div class="card-body">
                <h4>
                    Test Details
                </h4>
                <hr>
                <table class="table table-hovered">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        @foreach ($tests as $key => $item)<tr>
                            <td>{{$key + 1}}</td>
                            <td>{{\App\Tests::where('id', $item->tests_id)->value("name")}}</td>
                            <td>N{{\App\Tests::where('id', $item->tests_id)->value("price")}}</td>
                        </tr>
                        <?php $total += \App\Tests::where('id', $item->tests_id)->value("price"); ?>
                        @endforeach
                        <?php $total = $total - \App\Discounts::where("trx_id", $trx_id)->value("discount") ?>
                        <tr>
                            <td colspan="2"><b>Discount</b></td>
                            <td>   {{ !is_null(\App\Discounts::where("trx_id", $trx_id)->value("discount")) ? App\Discounts::where("trx_id", $trx_id)->value("discount") : 0 }}%
                            </td>

                        </tr>
                        <tr>
                            <td colspan="2"><b> Total </b></td>
                            <td>   <?php $total = $total - ($total*(\App\Discounts::where("trx_id", $trx_id)->value("discount"))/100) ?>
                                    N{{  $total}}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection