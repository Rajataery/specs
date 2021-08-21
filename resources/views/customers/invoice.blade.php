<!DOCTYPE html>
<!--
  Invoice template by invoicebus.com
  To customize this template consider following this guide https://invoicebus.com/how-to-create-invoice-template/
  This template is under Invoicebus Template License, see https://invoicebus.com/templates/license/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Invoicebus Invoice Template">
    <meta name="author" content="Invoicebus">

    <meta name="template-hash" content="baadb45704803c2d1a1ac3e569b757d5">

    <link rel="stylesheet" href="css/template.css">
  </head>
  <body>
    <div id="container">
      <section id="memo">
    

      <img src="http://specs.devwepro.com/frontend/images/FirstAidGuruLogo.jpg" alt="" style="width:150px;">
        
        <div class="company-info">

          <span style=" font-size: 20px;color: #B32C39;">First Aid Guru</span>
          <br>
          <span>123 street , near station ,uk</span>
          <br>
        
        </div>

      </section>

      <section id="invoice-title-number">
      
        <span id="title">Invoice</span>
        <span id="number"></span>
        
      </section>
      
      <div class="clearfix"></div>
      
      <section id="client-info">
        <span> To: </span>
        <div>
          <span class="bold">{{ ucfirst($data[0]['name'])}}</span>
        </div>
        <div>
          <span>{{$data[0]['phone']}}</span>
        </div>
        
        <div>
          <span>{{$data[0]['email']}}</span>
        </div>

        <!-- <div>
          <span>{{$data[0]['business_name']}}</span>
        </div> -->
      
      </section>
   
      <div class="clearfix"></div>
      
      <section id="items">
        
        <table cellpadding="0" cellspacing="0">
     
          <tr>
            <!-- Dummy cell for the row number and row commands -->
            <th>Course</th>
            
            @if($data[0]['type']=='in_house')
            <th>Participant</th>
            @endif
            <th>Price</th>
           
            <th>Total</th>
          </tr>
         
          <tr data-iterate="item">
           
            @if($data[0]['type']=='public')
            <td>{{@$data[0]->getdate->event_title}}</td>
            @else
            <td>{{@$data[0]->course->course_name}}</td>
            @endif
            @if($data[0]['type']=='in_house')
            <td>{{$data[0]['participants']}}</td>
            @endif
            <td>£{{$data[0]['price']}}</td>
            <td>£{{$data[0]['price']}}</td>
          </tr>
          
        </table>
        
      </section>
      
      <br>
      
      <div class="clearfix"></div>

      <section id="invoice-info">
        <div>

          @if($data[0]['type']=='public')
          <span>Date : </span> <span>{{@$data[0]->getdate->Date}}</span>
          @else
          <span>Date : </span> <span>{{$data[0]->date}}</span>
          @endif
        </div>
        <div>
          @if($data[0]['type']=='public')
          <span>End Date : </span> <span>{{@$data[0]->getdate->end_date}}</span>
          @else
          <span>Course Duration : </span> <span>{{@$data[0]->course->course_time}} Days</span>
          @endif
        </div>
        <div>
          <span>Currency : </span> <span>£</span>
        </div>
      </section>
      
      <section id="terms">

        <div class="notes"></div>


        <div class="payment-info">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
        
      </section>

      <div class="clearfix"></div>

      <!-- <div class="thank-you">THANKS!</div> -->

      <div class="clearfix"></div>
    </div>

    <script src="http://cdn.invoicebus.com/generator/generator.min.js?data=data.js"></script>
  
    <style type="text/css">
      /*! Invoice Templates @author: Invoicebus @email: info@invoicebus.com @web: https://invoicebus.com @version: 1.0.0 @updated: 2015-02-27 16:02:34 @license: Invoicebus */
/* Reset styles */
@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese");
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font: inherit;
  font-size: 100%;
  vertical-align: baseline;
}

html {
  line-height: 1;
}

ol, ul {
  list-style: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

caption, th, td {
  text-align: left;
  font-weight: normal;
  vertical-align: middle;
}

q, blockquote {
  quotes: none;
}
q:before, q:after, blockquote:before, blockquote:after {
  content: "";
  content: none;
}

a img {
  border: none;
}

article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
  display: block;
}


html, body {
  /* MOVE ALONG, NOTHING TO CHANGE HERE! */
}


.clearfix {
  display: block;
  clear: both;
}

.hidden {
  display: none;
}

b, strong, .bold {
  font-weight: bold;
}

#container {
  font: normal 13px/1.4em 'Open Sans', Sans-serif;
  margin: 0 auto;
  min-height: 1158px;
  background: #F7EDEB url("../img/bg.png") 0 0 no-repeat;
  background-size: 100% auto;
  color: #5B6165;
  position: relative;
}

#memo {
  padding-top: 50px;
  margin: 0 110px 0 60px;
  border-bottom: 1px solid #ddd;
  height: 115px;
}
#memo .logo {
  float: left;
  margin-right: 20px;
}
#memo .logo img {
  width: 150px;
  height: 100px;
}
#memo .company-info {
  float: right;
  text-align: right;
}
#memo .company-info > div:first-child {
  line-height: 1em;
  font-weight: bold;
  font-size: 22px;
  color: #B32C39;
}
#memo .company-info span {
  font-size: 11px;
  display: inline-block;
  min-width: 20px;
}
#memo:after {
  content: '';
  display: block;
  clear: both;
}

#invoice-title-number {
  font-weight: bold;
  margin: 30px 0;
}
#invoice-title-number span {
  line-height: 0.88em;
  display: inline-block;
  min-width: 20px;
}
#invoice-title-number #title {
  text-transform: uppercase;
  padding: 0px 2px 0px 60px;
  font-size: 50px;
  background: #F4846F;
  color: white;
}
#invoice-title-number #number {
  margin-left: 10px;
  font-size: 35px;
  position: relative;
  top: -5px;
}

#client-info {
  float: left;
  margin-left: 60px;
  margin-bottom: 20px;
  min-width: 220px;
}
#client-info > div {
  margin-bottom: 3px;
  min-width: 20px;
}
#client-info span {
  display: block;
  min-width: 20px;
}
#client-info > span {
  text-transform: uppercase;
}

table {
  table-layout: fixed;
}
table th, table td {
  vertical-align: top;
  word-break: keep-all;
  word-wrap: break-word;
}

#items {
  margin: 35px 30px 0 30px;
}
#items .first-cell, #items table th:first-child, #items table td:first-child {
  width: 150px !important;
  text-align: left;
}
#items table {
  border-collapse: separate;
  width: 100%;
}
#items table th {
  font-weight: bold;
  padding: 5px 8px;
  text-align: left;
  background: #B32C39;
  color: white;
  text-transform: uppercase;
}
#items table th:nth-child(2) {
  width: 30%;
  text-align: left;
}
#items table th:last-child {
  text-align: left;
}
#items table td {
  padding: 9px 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
#items table td:nth-child(2) {
  text-align: left;
}

#sums {
  margin: 25px 30px 0 0;
  background: url("../img/total-stripe-firebrick.png") right bottom no-repeat;
}
#sums table {
  float: right;
}
#sums table tr th, #sums table tr td {
  min-width: 100px;
  padding: 9px 8px;
  text-align: right;
}
#sums table tr th {
  font-weight: bold;
  text-align: left;
  padding-right: 35px;
}
#sums table tr td.last {
  min-width: 0 !important;
  max-width: 0 !important;
  width: 0 !important;
  padding: 0 !important;
  border: none !important;
}
#sums table tr.amount-total th {
  text-transform: uppercase;
}
#sums table tr.amount-total th, #sums table tr.amount-total td {
  font-size: 15px;
  font-weight: bold;
}
#sums table tr:last-child th {
  text-transform: uppercase;
}
#sums table tr:last-child th, #sums table tr:last-child td {
  font-size: 15px;
  font-weight: bold;
  color: white;
}

#invoice-info {
  float: left;
  margin: 50px 40px 0 60px;
 
}
#invoice-info > div > span {
  display: inline-block;
  min-width: 20px;
  min-height: 18px;
  margin-bottom: 3px;
}
#invoice-info div {
    margin-bottom: 7px;
}
#invoice-info > div > span:first-child {
  color: black;
}
#invoice-info > div > span:last-child {
  color: #aaa;
}
#invoice-info:after {
  content: '';
  display: block;
  clear: both;
}

#terms {
  float: left;
  margin-top: 50px;
}
#terms .notes {
  min-height: 30px;
  min-width: 50px;
  color: #B32C39;
}
#terms .payment-info div {
  margin-bottom: 3px;
  min-width: 20px;
}

.thank-you {
  margin: 10px 0 30px 0;
  display: inline-block;
  min-width: 20px;
  text-transform: uppercase;
  font-weight: bold;
  line-height: 0.88em;
  float: right;
  padding: 0px 20px 0px 2px;
  font-size: 30px;
  background: #F4846F;
  color: white;
}

.ib_bottom_row_commands {
  margin-left: 30px !important;
}

/**
 * If the printed invoice is not looking as expected you may tune up
 * the print styles (you can use !important to override styles)
 */
@media print {
  /* Here goes your print styles */
}

    </style>

  </body>
</html>
