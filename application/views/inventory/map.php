<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-folder-o"></i> Inventory</a></li>
                <li class="active">Access Control</li>
            </ol>


            <div class="col-xs-12">
                <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
                
                <!-- <img src="<?php //echo base_url('assets/img/map1.jpg'); ?>" usemap="#image-map" class="image" width="1000px"> -->
                <!-- <map name="image-map">
                    <area target="" alt="AA" title="AA" href="<?php //echo site_url('inventory/creategenset'); ?>" coords="65,21,239,163" shape="rect">
                    <area target="" alt="BA" title="BA" href="" coords="269,23,539,448" shape="rect">
                    <area target="" alt="CA" title="CA" href="" coords="548,21,750,175" shape="rect">
                    <area target="" alt="CB" title="CB" href="" coords="547,188,778,451" shape="rect">
                </map> -->
                <style type="text/css">
                    ul#map {
                        background: url(<?php echo base_url('assets/img/maptso.jpg'); ?>) no-repeat;
                        width: 1244px;
                        height: 778px;
                        position: relative;
                        list-style: none;
                    }

                    ul#map li {
                        position: absolute;
                        opacity: 0.5;
                    }

                    ul#map li:hover {
                        opacity: 1.0;
                        background:none;
                    }

                    .rack.active {
                        background: green;
                    }

                    .ac28 { top: 196px; left: 197px; width: 32px; height: 15px; background-color: black; }
                    .ac27 { top: 212px; left: 197px; width: 32px; height: 15px; background-color: black; }
                    .ac26 { top: 228px; left: 197px; width: 32px; height: 15px; background-color: black; }
                    .ac25 { top: 244px; left: 197px; width: 32px; height: 15px; background-color: black; }
                    .ac24 { top: 260px; left: 197px; width: 32px; height: 15px; background-color: black; }
                    .ac23 { top: 276px; left: 197px; width: 32px; height: 15px; background-color: black; }
                    .ac22 { top: 292px; left: 197px; width: 32px; height: 15px; background-color: black; }
                    .ac21 { top: 308px; left: 197px; width: 32px; height: 15px; background-color: black; }
                    .ac20 { top: 324px; left: 197px; width: 32px; height: 15px; background-color: black; }
                    .ac19 { top: 340px; left: 197px; width: 32px; height: 15px; background-color: black; }
                    .ac18 { top: 356px; left: 197px; width: 32px; height: 15px; background-color: black; }

                    .ag28 { top: 196px; left: 246px; width: 32px; height: 15px; background-color: black; }
                    .ag27 { top: 212px; left: 246px; width: 32px; height: 15px; background-color: black; }
                    .ag26 { top: 228px; left: 246px; width: 32px; height: 15px; background-color: black; }
                    .ag25 { top: 244px; left: 246px; width: 32px; height: 15px; background-color: black; }
                    .ag24 { top: 260px; left: 246px; width: 32px; height: 15px; background-color: black; }
                    .ag23 { top: 276px; left: 246px; width: 32px; height: 15px; background-color: black; }
                    .ag22 { top: 292px; left: 246px; width: 32px; height: 15px; background-color: black; }
                    .ag21 { top: 308px; left: 246px; width: 32px; height: 15px; background-color: black; }
                    .ag20 { top: 324px; left: 246px; width: 32px; height: 15px; background-color: black; }
                    .ag19 { top: 340px; left: 246px; width: 32px; height: 15px; background-color: black; }
                    .ag18 { top: 356px; left: 246px; width: 32px; height: 15px; background-color: black; }

                    .aj28 { top: 196px; left: 312px; width: 32px; height: 15px; background-color: black; }
                    .aj27 { top: 212px; left: 312px; width: 32px; height: 15px; background-color: black; }
                    .aj26 { top: 228px; left: 312px; width: 32px; height: 15px; background-color: black; }
                    .aj25 { top: 244px; left: 312px; width: 32px; height: 15px; background-color: black; }
                    .aj24 { top: 260px; left: 312px; width: 32px; height: 15px; background-color: black; }
                    .aj23 { top: 276px; left: 312px; width: 32px; height: 15px; background-color: black; }
                    .aj22 { top: 292px; left: 312px; width: 32px; height: 15px; background-color: black; }
                    .aj21 { top: 308px; left: 312px; width: 32px; height: 15px; background-color: black; }
                    .aj20 { top: 324px; left: 312px; width: 32px; height: 15px; background-color: black; }
                    .aj19 { top: 340px; left: 312px; width: 32px; height: 15px; background-color: black; }
                    .aj18 { top: 356px; left: 312px; width: 32px; height: 15px; background-color: black; }

                    .an28 { top: 196px; left: 361px; width: 32px; height: 15px; background-color: black; }
                    .an27 { top: 212px; left: 361px; width: 32px; height: 15px; background-color: black; }
                    .an26 { top: 228px; left: 361px; width: 32px; height: 15px; background-color: black; }
                    .an25 { top: 244px; left: 361px; width: 32px; height: 15px; background-color: black; }
                    .an24 { top: 260px; left: 361px; width: 32px; height: 15px; background-color: black; }
                    .an23 { top: 276px; left: 361px; width: 32px; height: 15px; background-color: black; }
                    .an22 { top: 292px; left: 361px; width: 32px; height: 15px; background-color: black; }
                    .an21 { top: 308px; left: 361px; width: 32px; height: 15px; background-color: black; }
                    .an20 { top: 324px; left: 361px; width: 32px; height: 15px; background-color: black; }
                    .an19 { top: 340px; left: 361px; width: 32px; height: 15px; background-color: black; }
                    .an18 { top: 356px; left: 361px; width: 32px; height: 15px; background-color: black; }

                    .aq28 { top: 196px; left: 427px; width: 32px; height: 15px; background-color: black; }
                    .aq27 { top: 212px; left: 427px; width: 32px; height: 15px; background-color: black; }
                    .aq26 { top: 228px; left: 427px; width: 32px; height: 15px; background-color: black; }
                    .aq25 { top: 244px; left: 427px; width: 32px; height: 15px; background-color: black; }
                    .aq24 { top: 260px; left: 427px; width: 32px; height: 15px; background-color: black; }
                    .aq23 { top: 276px; left: 427px; width: 32px; height: 15px; background-color: black; }
                    .aq22 { top: 292px; left: 427px; width: 32px; height: 15px; background-color: black; }
                    .aq21 { top: 308px; left: 427px; width: 32px; height: 15px; background-color: black; }
                    .aq20 { top: 324px; left: 427px; width: 32px; height: 15px; background-color: black; }
                    .aq19 { top: 340px; left: 427px; width: 32px; height: 15px; background-color: black; }
                    .aq18 { top: 356px; left: 427px; width: 32px; height: 15px; background-color: black; }

                    .aw26 { top: 228px; left: 509px; width: 32px; height: 15px; background-color: black; }
                    .aw25 { top: 244px; left: 509px; width: 32px; height: 15px; background-color: black; }
                    .aw24 { top: 260px; left: 509px; width: 32px; height: 15px; background-color: black; }
                    .aw17 { top: 372px; left: 509px; width: 32px; height: 15px; background-color: black; }
                    .aw16 { top: 388px; left: 509px; width: 32px; height: 15px; background-color: black; }
                    .aw15 { top: 404px; left: 509px; width: 32px; height: 15px; background-color: black; }
                    .aw13 { top: 436px; left: 509px; width: 32px; height: 15px; background-color: black; }
                    /*
                    map > area {
                        background: red;
                    }*/
                    
                   /* table#map {
                        background: url(<?php echo base_url('assets/img/map1.jpg'); ?>) center no-repeat;
                        background-size: cover;
                        background-position-x: 2px;
                        background-position-y: -6px;
                    }

                    table#map tr td {
                        width: 25px;
                        height: 18px;
                        opacity: 0.5;

                        /*background: red;*/
                        /*border: 1px solid #000;*/
                    /*}*/
                </style>
               
                <!-- Modal -->
                <?php 
                $rowslength = 58;
                ?>

                <ul id="map">
                    <li class="rack ac28"></li>
                    <li class="rack ac27"></li>
                    <li class="rack ac26"></li>
                    <li class="rack ac25"></li>
                    <li class="rack ac24"></li>
                    <li class="rack ac23"></li>
                    <li class="rack ac22"></li>
                    <li class="rack ac21"></li>
                    <li class="rack ac20"></li>
                    <li class="rack ac19"></li>
                    <li class="rack ac18"></li>

                    <li class="rack ag28"></li>
                    <li class="rack ag27"></li>
                    <li class="rack ag26"></li>
                    <li class="rack ag25"></li>
                    <li class="rack ag24"></li>
                    <li class="rack ag23"></li>
                    <li class="rack ag22"></li>
                    <li class="rack ag21"></li>
                    <li class="rack ag20"></li>
                    <li class="rack ag19"></li>
                    <li class="rack ag18"></li>

                    <li class="rack aj28"></li>
                    <li class="rack aj27"></li>
                    <li class="rack aj26"></li>
                    <li class="rack aj25"></li>
                    <li class="rack aj24"></li>
                    <li class="rack aj23"></li>
                    <li class="rack aj22"></li>
                    <li class="rack aj21"></li>
                    <li class="rack aj20"></li>
                    <li class="rack aj19"></li>
                    <li class="rack aj18"></li>

                    <li class="rack an28"></li>
                    <li class="rack an27"></li>
                    <li class="rack an26"></li>
                    <li class="rack an25"></li>
                    <li class="rack an24"></li>
                    <li class="rack an23"></li>
                    <li class="rack an22"></li>
                    <li class="rack an21"></li>
                    <li class="rack an20"></li>
                    <li class="rack an19"></li>
                    <li class="rack an18"></li>

                    <li class="rack aq28"></li>
                    <li class="rack aq27"></li>
                    <li class="rack aq26"></li>
                    <li class="rack aq25"></li>
                    <li class="rack aq24"></li>
                    <li class="rack aq23"></li>
                    <li class="rack aq22"></li>
                    <li class="rack aq21"></li>
                    <li class="rack aq20"></li>
                    <li class="rack aq19"></li>
                    <li class="rack aq18"></li>

                    <li class="rack aw26"></li>
                    <li class="rack aw25"></li>
                    <li class="rack aw24"></li>

                    <li class="rack aw17"></li>
                    <li class="rack aw16"></li>
                    <li class="rack aw15"></li>

                    <li class="rack aw13"></li>
                </ul>

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                
                    <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Type Hardware</th>
                                                <th>Serial Number</th>
                                                <th>Hostname</th>
                                                <th>PIC</th>
                                                <th>PO Kontak</th>
                                            </tr>
                                        </thead>
                                        <tbody id="modal-table">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<script type="text/javascript">
    var data = <?php echo json_encode($data); ?>;
    window.addEventListener('load', function() {
        // rack active 
        if(data) {
            for (var i = 0; i < data.length; i++) {
                $('.'+ data[i]['coor_rack'].toLocaleLowerCase()).addClass('active');
            }
        }

        $('ul#map li.active').on('click', function(evt) {

            var classes = $(this).attr('class').split(/\s+/);
            var rackId = classes[1];
            // title rack modal
            $('.modal-title').html(rackId.toUpperCase());


            // filter data berdasarkan rack
            var devices = data.filter(function(val) {
                if(rackId == val['coor_rack'].toLocaleLowerCase()) return true;
                return false;
            });

            $('#modal-table').html(null);
            for (var i = 0; i < devices.length; i++) {
                $('#modal-table').append('<tr>'+
                                            '<td>'+(i+1)+'</td>'+
                                            // '<td>'+(devices[i]['coor_rack'])+'</td>'+
                                            '<td>'+(devices[i]['type_hardware'])+'</td>'+
                                            '<td>'+(devices[i]['sn'])+'</td>'+
                                            '<td>'+(devices[i]['hostname'])+'</td>'+
                                            '<td>'+(devices[i]['pic'])+'</td>'+
                                            '<td>'+(devices[i]['po_number'])+'</td>'+
                                        '</tr>');
            }

            $('#myModal').modal('show');

            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });
        });


    }, false );

</script>


