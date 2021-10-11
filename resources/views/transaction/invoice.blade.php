
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Invoice</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            .clearfix:after {
            content: "";
            display: table;
            clear: both;
            }

            a {
            color: #5D6975;
            text-decoration: underline;
            }

            body {
            position: relative;
            width: 21cm;  
            height: 29.7cm; 
            margin: 0 auto; 
            color: #001028;
            background: #FFFFFF; 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            font-family: Arial;
            }

            header {
            padding: 10px 0;
            margin-bottom: 30px;
            }

            #logo {
            text-align: center;
            margin-bottom: 10px;
            }

            #logo img {
            width: 90px;
            }

            h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
            }

            #project {
            float: left;
            }

            #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
            }

            #company {
            float: right;
            text-align: right;
            }

            #project div,
            #company div {
            white-space: nowrap;        
            }

            table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
            background: #F5F5F5;
            }

            table th,
            table td {
            text-align: center;
            }

            table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;        
            font-weight: normal;
            }

            table .service,
            table .desc {
            text-align: left;
            }

            table td {
            padding: 20px;
            text-align: right;
            }

            table td.service,
            table td.desc {
            vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
            font-size: 1.2em;
            }

            table td.grand {
            border-top: 1px solid #5D6975;;
            }

            #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
            }

            footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
        <div id="logo">
            <img class="mb-4" src="https://dansmultipro.com/wp-content/uploads/2020/03/logo_web_header-810x180-1.png" alt="" width="50%">
        </div>
        <h1>INVOICE #{{$data->id}}</h1>
        <div class="row">
            <div id="project">
                <div><span>CUSTOMER</span> {{$customer->name}}</div>
                <div><span>EMAIL</span> <a href="mailto:john@example.com">{{$customer->email}}</a></div>
                <div><span>PHONE</span> {{$customer->phone}}</div>
                <div><span>DUE DATE</span> {{$booking->checkout}}</div>
            </div>
        </div>
        </header>
        <main>
        <table class="table" style="width: 700px">
            <thead class="text-center">
                <tr>
                    <th class="service">SERVICE</th>
                    <th class="desc">DESCRIPTION</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="service">
                        <strong>{{$room->type_room}}</strong><br>
                        <span>{{$room->type_bed}}</span>
                    </td>
                    <td class="desc">
                        {{$room->description}} <br>
                        {{$booking->checkin}} - {{$booking->checkout}} <br>
                        {{$booking->total}} Hari
                    </td>
                    <td class="unit">Rp. {{$data->total}}</td>
                </tr>
                <tr>
                    <td colspan="2">SUBTOTAL</td>
                    <td class="total">Rp. {{$data->total}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="grand total">GRAND TOTAL</td>
                    <td class="grand total">Rp. {{$data->total}}</td>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
        </main>
        <footer>
        Invoice was created on a computer and is valid without the signature and seal.
        </footer>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>