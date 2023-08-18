<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<section class="content-header">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="top-left-header">Daily Summary Report </h2>
        </div>
    </div>
<hr style="border: 1px solid #0C5889;">
    <div class="row"> 
        <div class="col-md-3">
            <?php echo form_open(base_url() . 'Report/dailySummaryReport') ?>
            <div class="form-group"> 
                <input tabindex="1" type="text" id="date" name="date" class="form-control" placeholder="Date" value="<?php echo set_value('date'); ?>">
            </div> 
        </div>
        <div class="col-md-2">
            <button type="submit" name="submit" value="submit" class="btn btn-block btn-primary pull-left">Submit</button>
        </div> 
    </div> 
</section> 
<style type="text/css">
 h1,h2,h3,h4,p{
    margin:3px 0px;
}
.body_area{
    padding:1px;
} 
.tbl  {
    border-collapse:collapse;
    border-spacing:0;
    width: 100%;
} 
.content{
    border: 0px !important;
} 
.tbl_body td{
    font-family:Arial, sans-serif;
    font-size:15px;
    padding:5px 5px;
    border-style:solid;
    border-width:1px;
    word-break:break-all;
}
/*
.tbl td{
    font-family:Arial, sans-serif;
    font-size:15px;
    padding:5px 5px;
    border-style:solid;
    border-width:1px;
    word-break:break-all;
}
.tbl th{
    font-family:Arial, sans-serif;
    font-size:17px;
    font-weight:normal;
    padding:5px 5px;
    border-style:solid;
    border-width:1px;
    word-break:break-all;
    background-color:#f9f9f9;
    font-weight:bold;
}
.tbl .tbl-s6z2{text-align:center;}
.primary_area {
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    background: #fff;
}

.headers{
    text-align:center;
    background: #fff;
    margin-bottom:10px; 
} */
.main_header{
    text-align: center !important;
}
.title{
    font-weight: bold;
}

</style> 
<section class="content">
    <div class="row">
        <div class="col-md-offset-10 col-md-1">
            <button class="btn btn-block btn-primary pull-left"><i class="fa fa-file-pdf-o"></i></button>  
        </div>
        <div class="col-md-1">
            <button class="btn btn-block btn-primary pull-left"><i class="fa fa-file-excel-o"></i></button>   
        </div>
    </div> 
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- /.box-header -->
                <div class="box-body table-responsive"> 
                    <table class="tbl" id="content">
                        <thead >
                            <tr class="main_header">
                                <td colspan="8"><h3>Daily Summary Report</h3></td>
                            </tr>
                            <tr class="main_header">
                                <td colspan="8"><h5>Date: 12.01.2018</h5></td>
                            </tr>
                        </thead>
                        <tbody class="tbl_body">
                            <tr>
                                <td class="title">1. Purchase</td>
                                <td class="value">3434.22 <?php echo $this->session->userdata('currency'); ?></td>
                                <td class="title">2. Sale (Total)</td>
                                <td class="value">3434.22 <?php echo $this->session->userdata('currency'); ?></td>
                                <td class="title">3. Sale (In Card)</td>
                                <td class="value">3434.22 <?php echo $this->session->userdata('currency'); ?></td>
                                <td class="title">4. Sale (In Cash)</td>
                                <td class="value">3434.22 <?php echo $this->session->userdata('currency'); ?></td>
                            </tr>
                            <tr>
                                <td class="title">5. Waste</td>
                                <td class="value">3434.22 <?php echo $this->session->userdata('currency'); ?></td>
                                <td class="title">6. Expense</td>
                                <td class="value">3434.22 <?php echo $this->session->userdata('currency'); ?></td>
                                <td class="title">7. Supplier Payment</td>
                                <td class="value">3434.22 <?php echo $this->session->userdata('currency'); ?></td>
                                <td class="title">8. Total VAT</td>
                                <td class="value">3434.22 <?php echo $this->session->userdata('currency'); ?></td>
                            </tr>
                            <tr>
                                <td class="title">9. Inventory Value</td>
                                <td class="value">3434.22 <?php echo $this->session->userdata('currency'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div> 
        </div> 
    </div> 
    <button class="btn btn-primary" onclick="return demoFromHTML()">test</button>
</section>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js" integrity="sha384-CchuzHs077vGtfhGYl9Qtc7Vx64rXBXdIAZIPbItbNyWIRTdG0oYAqki3Ry13Yzu" crossorigin="anonymous"></script>
<script>
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#content')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }, margins
        );
    }
</script>