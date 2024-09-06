@extends('partials.client')
@section('title', 'All Test')
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
                        <th>Department</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        @foreach ($tests as $key => $item)<tr>
                            <td>{{$key + 1}}</td>
                            <td>{{\App\Tests::where('id', $item->tests_id)->value("name")}}</td>
                            <td>{{\App\Departments::where('id', $item->department)->value("name")}}</td>
                            <td>N{{\App\Tests::where('id', $item->tests_id)->value("price")}}</td>
                        </tr>
                        <?php $total += \App\Tests::where('id', $item->tests_id)->value("price"); ?>
                        @endforeach
                        <?php $total = $total - ($total * (\App\Discounts::where("trx_id", $trx_id)->value("discount")/100)) ?>
                        <tr>
                            <td colspan="2"><b>Discount</b></td>
                            <td>{{ !is_null(\App\Discounts::where("trx_id", $trx_id)->value("discount")) ? App\Discounts::where("trx_id", $trx_id)->value("discount") : 0 }}%
                            </td>

                        </tr>
                        <tr>
                            <td colspan="2"><b> Total </b></td>
                            <td>N{{$total}}</td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection