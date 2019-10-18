@extends('layouts.app')
@section('style')
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
          //  border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <table id="customers" class="text-center">
        <tr>
            <td colspan="4">
                {{$data['company_name']}}
            </td>
        </tr>
        <tr>
            <td>Date</td>
            <td>{{$data['pay_to']}}</td>
            <td>Position</td>
            <td>{{$data['position']}}</td>
        </tr>
        <tr>
            <td>
                Name:
            </td>
            <td>
                {{$data['name']}}
            </td>
        </tr>
        <tr>
            <td>
                Gross
            </td>
            <td>
                {{$data['gross_pay']}}
            </td>
            <td>
                Gross YTD
            </td>
            <td>
                {{$data['ytd_gross']}}
            </td>
        </tr>
        <tr>
            <td>
                Net
            </td>
            <td>
                {{$data['net_pay']}}
            </td>

            <td>
                Net YTD
            </td>
            <td>
                {{$data['ytd_net']}}
            </td>
        </tr>

    </table>
</div>
@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection