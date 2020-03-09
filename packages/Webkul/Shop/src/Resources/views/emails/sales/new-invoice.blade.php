@component('shop::emails.layouts.master')
    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #ffffff;
            color: #000000;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
        hr.blackSolid {
            border-top: 1px solid black;
        }
        .table-custom {
            margin-left: 30px;
            margin-right: 50px;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <div style="text-align: center;">
        <a href="{{ config('app.url') }}">
            @include ('shop::emails.layouts.logo')
        </a>
    </div>

    <?php $order = $invoice->order; ?>

    <!-- <div style="padding: 30px;"> -->

      <div class="information">
          <table width="100%">
              <tr style="top:5px;">
                  <td align="center">
                      <h2>Pokli Wealth Management Sdn Bhd (1349069-M)</h2>
                      <pre style="font-size: 10px">
                      Wisma Pokli,101A- 1 Avenue,Jalan S2F2,Garden Homes, Seremban 270300 Seremban, Negeri Sembilan
                      Tel : +6019-664 5066
                      Email : admin@pokli.com
                      Website : www.pokli.com.my
                      </pre>
                  </td>
              </tr>
          </table>
      </div>

      <div class="information">
          <table width="100%">
              <tr style="top:5px;">
                  <td align="left" style="width: 60%;">
                      <pre style="font-size: 10px">

                      Order Number: {{ $invoice->order->increment_id }}
                      <br /><br />
                      Date: {{ date('d/m/Y', strtotime($invoice->created_at)) }}
                      {{ $invoice->order->billing_address->name }}
                      {{ $invoice->order->customer->ic }}
                      {{ $invoice->order->customer->phone }}
                      {{ $invoice->order->customer->email }}
                      <br /><br />
                      Address:
                      {{ $invoice->order->billing_address->address1 }}
                      {{ $invoice->order->billing_address->city }}, {{ $invoice->order->billing_address->state }}
                      </pre>
                  </td>
                  <td align="left" style="width: 40%;">
                      <pre style="font-size: 10px">
                      <br/>
                      @if ($invoice->order->shipping_address)
                          Payment By: {{ core()->getConfigData('sales.paymentmethods.' . $invoice->order->payment->method . '.title') }}
                      @endif
                      </pre>
                  </td>
              </tr>
          </table>
      </div>

      <div class="information">
          <table width="100%" class="table-custom">
              <tr>
                  <td align="center" style="width: 20%;border: 1px solid black;">
                      <b>Serial Number</b>
                  </td>
                  <td align="center" style="width: 40%;border: 1px solid black;">
                      <b>Description</b>
                  </td>
                  <td align="center" style="width: 20%;border: 1px solid black;">
                      <b>Quantity</b>
                  </td>
                  <td align="center" style="width: 30%;border: 1px solid black;">
                      <b>Total Amount (RM)</b>
                  </td>
              </tr>
              @foreach ($invoice->items as $item)
              <tr>
                <!-- serial number here -->
                  <td align="center" style="width: 20%;border: 1px solid black;">
                  <pre style="font-size: 10px"><br></pre>
                  </td>
                  <td align="center" style="width: 40%;border: 1px solid black;">
                  <pre style="font-size: 10px"> {{ $item->name }}</pre>
                  </td>
                  <td align="center" style="width: 20%;border: 1px solid black;">
                  <pre style="font-size: 10px">{{ $item->qty }}</pre>
                  </td>
                  <td align="center" style="width: 30%;border: 1px solid black;">
                  <pre style="font-size: 10px">{{$item->base_total + $item->base_tax_amount }}</pre>
                  </td>
              </tr>
              @endforeach
              <tr>
                  <td colspan="2" style="border: 1px solid white; border-right:1px solid black;"></td>
                  <td style="border: 1px solid black;border-right:0px  white;" align="left">
                    <pre style="font-size: 10px">
                    <b>Premium :</b><br>
                    <b>Grand Total :</b>
                    </pre>
                  </td>
                  <td style="border: 1px solid black;border-left:0px  white;" align="center">
                    <pre style="font-size: 10px">
                    <b>{{ core()->formatBasePrice($invoice->base_shipping_amount) }}</b><br>
                    <b>{{ core()->formatBasePrice($invoice->base_grand_total) }}</b>
                    </pre>
                  </td>
              </tr>
          </table>
      </div>
      <div class="information">
          <table width="100%">
              <tr style="top:1px;">
                  <td align="left" style="width: 60%;">
                      <pre style="font-size: 9px">
                      <b>Risk Disclosure:</b>
                      <br />
                      You are considering dealing with Pokli Wealth Management Sdn Bhd, trading in bullion involves the potential for profit as
                      well as the risk of loss. Movements in the price of bullion rates are influenced by a variety of factors of global origin which are
                      unpredictable. Violent movement in the price of bullion rates may result in action by the market as a result of which you may be
                      incurring extra loss. However, please note that this disclosure cannot and does not explain all the risks involved. Some of the risks
                      associated with using our bullion trading facilities include:-
                      <br />
                      1. Customer should read through all the related sales literature, prospectuses or other offering documents before making purchase.
                      2. Customer should carefully consider all precious metals risks and/ or considerations contained in the documents.
                      3. There is no assurance that the acquisition of precious metals will achieve your monetary gain objectives.
                      4. Customer should make certain that they understand the correlation between risk and return.
                      5. PWM will follow Public Gold margin spread and it will be maintained under normal political and social circumstances except for
                      extreme market conditions, such as financial and economic crisis, social unrest, political instability, war which can cause extreme
                      volatility of precious metal price in international market.
                      <br /><br />
                      <b>Disclaimer:</b>
                      <br />
                      1. Pokli Wealth Management Sdn Bhd. (Pokli) does not offer any investment advice or promises/forecasts any assured return
                      through this program while promoting the product.
                      2. Pokli management reserves the right to amend the terms and conditions without prior notice.
                      </pre>
                  </td>
              </tr>
          </table>
      </div>

      <hr class="blackSolid" width="85%" style="margin-top:0px;margin-bottom:0px;">
    <!-- </div> -->
@endcomponent
