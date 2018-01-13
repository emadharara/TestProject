<!doctype html>
<html lang="{{ app()->getLocale() }}">
<?php

use App\Http\Controllers\accountCon;
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrab4/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrab4/css/uikit.min.css" rel="stylesheet">
    <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/main.css">
    <link rel="stylesheet" href="assets/main2.css">

    <!-- CSS -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <title>Laravel</title>
</head>
<style>
    .hidden {
        display: none;
    }

</style>
<body>
<div class="container">

    <div class="row" style="margin-top: 30px">
        <div class="col-sm-3">
            <select class="form-control " id="m_category">
                <option></option>
                <?php

                foreach ($cat as $arr){
                ?>
                <option value="<?php echo $arr->id?>"><?php echo $arr->name?></option>
                <?php }?>

            </select>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
            <div class="form-group ">

                <select class="form-control " id="m_sub_category">

                </select>
            </div>
        </div>

    </div>

    <div class="row" style="margin-top: 30px">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <table id="example" class=" aa display" cellspacing="0">
                <thead>
                <tr>
                    <th>رقم الحساب</th>
                    <th>اسم الحساب</th>
                    <th>مدين</th>
                    <th>دائن</th>
                    <th>اسم القسم</th>
                    <th>اسم الفرع</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>رقم الحساب</th>
                    <th>اسم الحساب</th>
                    <th>مدين</th>
                    <th>دائن</th>
                    <th>اسم القسم</th>
                    <th>اسم الفرع</th>
                </tr>

                </tfoot>
                <tbody>

                <?php
                foreach ($account as $arr){?>
                <tr class="rr">
                    <td class="accountId"><?php echo $arr->accountId  ?></td>
                    <td><?php echo $arr->accountName  ?></td>
                    <td class="md"><?php echo $arr->md;  ?></td>
                    <td class="dd"><?php echo $arr->dd  ?></td>
                    <?php
                    $catName = accountCon::getNameCat($arr->catId);
                    foreach ($catName as $c){?>
                    <td><?php echo $c->name  ?></td>
                    <?php   }?>

                    <?php
                    $subName = accountCon::getNamesub($arr->subCatId);
                    foreach ($subName as $c){?>
                    <td><?php echo $c->name  ?></td>
                    <?php   }?>
                </tr>
                <?php       }
                ?>

                <tr>
                    <td>&nbsp</td>
                    <td>&nbsp</td>
                    <td id="result">0</td>
                    <td id="result2">0</td>
                    <td>&nbsp</td>
                    <td >المجموع</td>

                </tr>

                </tbody>


            </table>
            <div></div>
        </div>

    </div>
</div>
<!--  end copyright-->
<script src="bootstrab4/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="bootstrab4/js/popper.js" type="text/javascript"></script>
<script src="bootstrab4/js/bootstrap.min.js" type="text/javascript"></script>
<script src="bootstrab4/js/uikit.min.js" type="text/javascript"></script>
<script src="bootstrab4/js/uikit-icons.min.js" type="text/javascript"></script>
<script src="{{asset('js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('js/main2.js')}}" type="text/javascript"></script>
<script src="{{asset('js/main3.js')}}" type="text/javascript">
</script>
<script src="{{asset('js/main4.js')}}" type="text/javascript"></script>
<script src="{{asset('js/main5.js')}}" type="text/javascript"></script>


<script>


    function getTotal() {
        var sum = 0;
        $('.md').each(function (i) {
            sum += parseInt($(this).text());

        });
        $('#result').text(sum);

        var sum2 = 0;
        $('.dd').each(function (i) {
            sum2 += parseInt($(this).text());

        });
        $('#result2').text(sum2);
    }
    $(document).ready(function () {


          getTotal();


        var table = $('#example').DataTable({

            dom: 'Bfrtip',
            paging: false,
            searching: false,
            retrieve: true,
            buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    rows: ':visible',

                },



            }]
        });


        $('#m_category').on('change', function () {

            $('.accountId').parents('.rr').addClass('hidden');
            var m_supCat = $(this).find('option:selected').val();



            $('#example tbody tr').each(function (k , v) {
                alert($(this).find('td:nth-child(3)').text());
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{url('getSup')}}",
                method: "get",
                data: {m_supCat: m_supCat},
                success: function (e) {
                    var supCatigory = $.parseJSON(e);
                    var tt = $('#m_sub_category');
                    tt.html('');
                    tt.append('<option>' +
                        '' +
                        '</option>'
                    );
                    $.each(supCatigory, function (k, v) {
                        tt.append('' +

                            '<option value="' +
                            v.id +
                            '">' +
                            v.name +
                            ' </option>');
                    });


                }

            });
            $.ajax({
                url: "{{url('getData')}}",
                method: "get",
                data: {m_supCat: m_supCat},
                success: function (e) {
                    var accounts = $.parseJSON(e);

                    var blkstr = [];
                    var blkstr2 = [];
                    $.each(accounts, function (tk, tv) {

                        $('#example tr').each(function (k, v) {
                            var idCol = $(this).find('.accountId').text();

                            if (idCol == tv.accountId) {
                                $(this).filter('.hidden').removeClass('hidden');

                                var a = tv.md;

                                var b = tv.dd;
                                blkstr.push(a);
                                blkstr2.push(b);
                            }

                        });

                    });
                    var summ = 0;
                    for (i = 0; i < blkstr.length; i++) {
                        summ += blkstr[i];
                    }

                      $('#result').text(summ);

                    var summ2 = 0;
                    for (i = 0; i < blkstr2.length; i++) {
                        summ2 += blkstr2[i];
                    }
                    $('#result2').text(summ2);


                }


            });

        });
        $('#m_sub_category').on('change', function () {
            $('.accountId').parents('.rr').addClass('hidden');
            var supCat = $(this).find('option:selected').val();
            var t = $('#m_sub_category');


            $.ajax({
                url: "{{url('getData2')}}",
                method: "get",
                data: {supCat: supCat},
                success: function (e) {


                    var account = $.parseJSON(e);
                    var blkstr3 = [];
                    var blkstr4 = [];
                    $.each(account, function (tk, tv) {
                        $('#example tr').each(function (k, v) {
                            var idCol2 = $(this).find('.accountId').text();
                            if (idCol2 == tv.accountId) {
                                $(this).filter('.hidden').removeClass('hidden');
                                var a2 = tv.md;

                                var b2 = tv.dd;
                                blkstr3.push(a2);
                                blkstr4.push(b2);
                            }

                        });
                    });
                    var summ3 = 0;
                    for (i = 0; i < blkstr3.length; i++) {
                        summ3 += blkstr3[i];
                    }


                    $('#result').text(summ3);

                    var summ4 = 0;
                    for (i = 0; i < blkstr4.length; i++) {
                        summ4 += blkstr4[i];
                    }
                    $('#result2').text(summ4);


                }

            });
        });


    });


</script>


</body>


</html>
