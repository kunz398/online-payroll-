@extends('layouts.app')
@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <table id="" class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
            <th>
                Period
            </th>

            <th>
                Net Pay
            </th>
            <th>
                View Detailed
            </th>
            </thead>
            <tbody>
            @foreach($pays as $pay)
                <tr>
                    <td>
                        {{  $pay['pay_from']}} - {{  $pay['pay_to']}}
                    </td>
                    <td>
                        {{ round($pay['net_pay'],2)}}
                    </td>
                    <td>
                        <a href="{{url('individual')}}/{{$pay['id']}}" class="btn btn-xs btn-outline-primary">View Details</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection