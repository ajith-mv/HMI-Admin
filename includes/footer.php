<!-- Footer -->

<footer class="footer text-right">
	<div class="container">
		<div class="row">
			<div class="col-xs-12"> HMI &copy;<?php echo date('Y'); ?>, All Rights Reserved. Designed & Developed by
				Pixel Studios</div>

		</div>
	</div>
</footer>
<!-- End Footer -->

</div>
<!-- end container -->

</div>

<!-- File Export  Start -->
<!--
		<script src="assets/plugins/fileexport/jquery-2.1.0.min.js"></script>
		
		<script src="assets/plugins/fileexport/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/fileexport/dataTables.buttons.min.js"></script>
		<script src="assets/plugins/fileexport/buttons.flash.min.js"></script>
		<script src="assets/plugins/fileexport/jszip.min.js"></script>
		<script src="assets/plugins/fileexport/pdfmake.min.js"></script>
		<script src="assets/plugins/fileexport/vfs_fonts.js"></script>
		<script src="assets/plugins/fileexport/buttons.html5.min.js"></script>
		<script src="assets/plugins/fileexport/buttons.print.min.js"></script>
-->
<!-- File Export End -->

<!--
<script type="text/javascript">
			
				$(document).ready(function() {
					$('#tblresult').DataTable( {
						 pageLength: '10',
						dom: 'Bfrtip',
						buttons: [
							'copy', 'csv', 'excel', 'pdf', 'print'
						]
					} );
				} );
			
</script>
-->

<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Datatables-->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/buttons.print.min.js"></script>
<script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>




<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js"></script>

<!-- jquery-confirm files -->
<script type="text/javascript" src="assets/plugins/jquery-confirm/js/jquery-confirm.js"></script>

<!-- Plugins Js -->
<script src="assets/plugins/switchery/switchery.min.js"></script>
<script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
<script src="assets/plugins/select2/dist/js/select2.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


<!-- Modal-Effect -->
<script src="assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="assets/plugins/custombox/dist/legacy.min.js"></script>

<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

<script src="assets/plugins/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {

		/*		product_name*/

		$("#ptitle").keypress(function () {
			var $this = $(this);
			window.setTimeout(function () {

				$("#product_url").val($this.val().toLowerCase().replace(/[^A-Z0-9]/ig, "-"));
			}, 0);
		});

		$("#cuname").keypress(function () {
			var $this = $(this);
			window.setTimeout(function () {

				$("#cuurl").val($this.val().toLowerCase().replace(/[^A-Z0-9]/ig, "-"));
			}, 0);
		});

		$("#pstitle").keypress(function () {
			var $this = $(this);
			window.setTimeout(function () {

				$("#pstitle_url").val($this.val().toLowerCase().replace(/[^A-Z0-9]/ig, "-"));
			}, 0);
		});

		/*		product_name*/
		if ($("#elm1").length > 0) {
			tinymce.init({
				selector: "textarea#elm1",
				theme: "modern",
				height: 300,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
				style_formats: [
					{ title: 'Bold text', inline: 'b' },
					{ title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
					{ title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
					{ title: 'Example 1', inline: 'span', classes: 'example1' },
					{ title: 'Example 2', inline: 'span', classes: 'example2' },
					{ title: 'Table styles' },
					{ title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
				]
			});
		}
		if ($("#elm2").length > 0) {
			tinymce.init({
				selector: "textarea#elm2",
				theme: "modern",
				height: 300,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
				style_formats: [
					{ title: 'Bold text', inline: 'b' },
					{ title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
					{ title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
					{ title: 'Example 1', inline: 'span', classes: 'example1' },
					{ title: 'Example 2', inline: 'span', classes: 'example2' },
					{ title: 'Table styles' },
					{ title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
				]
			});
		}

	});
</script>
<script type="text/javascript">

	var sucmsg = 'has been added successfully';
	var exsmsg = 'Already Exists';
	var upmsg = 'has been updated successfully';
	var reqmsg = 'Required fields should not be empty';
	var delmsg = 'Deleted successfully';
	var statusmsg = 'Status updated successfully';
	var exsmsg_email = 'Email ID already exists. Please try with other email ID to create account.';
	var exsmsg_phone = 'Mobile number already exists. Please try with other mobile number create account.';
	var exsmsg_reference = 'Reference exists with other data. Cannot be deleted.';
	var oldpass_reference = 'Old Password doesn`t match. Please enter right password.';
	var othmsg = 'Opps!!@ Server Error. Please retry again.';
	var exsmsg_refstats = 'Reference exists with other data. Cannot Perform the action.';
	var dataGridHdn;

	jQuery('.timepicker').timepicker({
		defaultTIme: false
	});

	//$( ".datepicker" ).datepicker();

	$(document).ready(function () {

		var currentPath = window.location.pathname;
		var splitPath = currentPath.split('/');
		var cPath = splitPath[splitPath.length - 1];
		if (cPath.indexOf('_') != -1) {
			var cPathSplit = cPath.split('_');
			if (cPathSplit[0].length > 0) {
				$('.submenu li').removeClass('active');
				$('.navigation-menu a').each(function () {
					var href = $.trim($(this).attr('href'));
					var hrefSplit = href.split('_');
					if (hrefSplit[0] == cPathSplit[0]) {
						$(this).closest('li').addClass('active');
						$(this).closest('ul').parent().addClass('active');
					}
				});
			}
		}


		$(".select2").select2();
		//  $('#datatable').dataTable();
		$('#datatable-keytable').DataTable({ keys: true });
		$('#datatable-responsive').DataTable();
		$('#datatable-scroller').DataTable({ ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true });
		var table = $('#datatable-fixed-header').DataTable({ fixedHeader: true });


	});
	TableManageButtons.init();



	//Data table all page display grid common function - START		
	function datatblCal(hdnFld) {
		var iColumns = $('#tblresult thead th').length;  // count all column length
		var sortrmvcloumn1 = parseInt(iColumns - 2); // sorting remove to action column
		var sortrmvcloumn2 = parseInt(iColumns - 1); // sorting remove to status column
		var sortrmvcloumn3 = parseInt(iColumns - 3);

		if ($('#disptblname').val() == 'newsevents') {
			var targ = [0, 1, 2, 3, 4, 5, 6];
		}

		if ($('#disptblname').val() == 'newseventscat') {
			var targ = [0, 1, 2];
		}
		if ($('#disptblname').val() == 'testimonial') {
			var targ = [0, 1, 2, 3];
		}

		if ($('#disptblname').val() == 'gallerycategories') {
			var targ = [0, 1, 2];
		}

		else if ($('#disptblname').val() == 'gallery') {
			var targ = [0, 1, 2, 3, 4, 5, 6];
		}

		else if ($('#disptblname').val() == 'noticeboard') {
			var targ = [0, 1, 2, 3, 4, 5];
		}

		else if ($('#disptblname').val() == 'stafflisting') {
			var targ = [0, 1, 2, 3, 4, 5, 6, 7, 8];
		}

		else if ($('#disptblname').val() == 'announcement') {
			var targ = [0, 1, 2, 3, 4, 5];
		}

		else if ($('#disptblname').val() == 'enquiries') {
			var targ = [0, 1, 2, 3, 4, 5];
		}

		else if ($('#disptblname').val() == 'career') {
			var targ = [0, 1, 2, 3, 4, 5, 6];
		}

		else if ($('#disptblname').val() == 'alumni') {
			var targ = [0, 1, 2, 3, 4, 5, 6];
		}

		else if ($('#disptblname').val() == 'admission') {
			var targ = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
		}

		else {
			var targ = [sortrmvcloumn1, sortrmvcloumn2];
		}

		var autoid = $('#autoid').val();
		var i = 0;
		var frmid = '';

		if ($('#frmpara').length > 0) {
			frmid = "&frmpara=" + $('#frmpara').val();
		}
		var i = 0;
		if (($('#disptblname').val() == 'enquiries') || ($('#disptblname').val() == 'excursion') || ($('#disptblname').val() == 'career') || ($('#disptblname').val() == 'alumni') || ($('#disptblname').val() == 'admission')) {
			var dataTable = $('#tblresult').dataTable({
				initComplete: function () {
					if (typeof hdnFld != 'undefined') {
					}
					unloading();
				},

				"pageLength": 10,
				"dom": 'lBfrtip',
				"buttons": [
					'copy', 'csv', 'excel', 'pdf'
				],
				"processing": true,
				"columnDefs": [{ "targets": targ, "orderable": false }],
				"destroy": true,
				"serverSide": true,
				"stateSave": true,
				"bStateSave": false,
				"language": { "processing": loading() },
				"ajax": {
					url: "display-grid-data.php?finaltab=" + $('#disptblname').val() + frmid + '&autoid=' + autoid, // json datasource				 
					type: "post",
					error: function () {
						$("#tblresult").append('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
						unloading();
					}
				},
			});
		}
		else {
			var dataTable = $('#tblresult').dataTable({

				initComplete: function () {
					if (typeof hdnFld != 'undefined') {
					}
					unloading();
				},

				"pageLength": 50,
				"processing": true,
				"columnDefs": [{ "targets": targ, "orderable": false }],
				"destroy": true,
				"serverSide": true,
				"stateSave": true,
				"bStateSave": false,
				"language": { "processing": loading() },
				"ajax": {
					url: "display-grid-data.php?finaltab=" + $('#disptblname').val() + frmid + '&autoid=' + autoid, // json datasource				 
					type: "post",  // method  , by default get
					error: function () {  // error handling                  
						$("#tblresult").append('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
						unloading();
					}
				},

			});
		}
	}
	//Data table all page display grid common function - END

	/**************** alert **************/
	function swal(title, text, type, btn) {
		$.confirm({
			title: title,
			content: text,
			type: type,
			buttons: {
				omg: {
					text: 'Okay',
					btnClass: btn,
				},
				/*close: function () {
				}*/
			}
		});
	}

	/**************************** Form Validation ****************************/
	//Save data to db all page common function - START		
	function funSubmt($frm, $urll, $acts, $stats, $lodlnk) {

		//alert($('#elm1').html()); 
		/*$('#txtEditor').val($('.Editor-editor').text());*/
		//alert($("#elm1").cleanHtml());





		$('#' + $acts).parsley().validate();
		if ($('#' + $acts).parsley().isValid()) {
			$("button").attr('disabled', true);

			$.ajax({
				url: $urll,
				method: 'POST',
				dataType: 'json',
				data: $("#" + $acts).serialize(),
				beforeSend: function () {
					loading();
				},
				success: function (response) {
					if (response.rslt == "1") {
						swal("Success!", $stats + ' ' + sucmsg, "green", "btn-green");
						$("#" + $acts)[0].reset();
						$(location).attr('href', $lodlnk);
					}
					else if (response.rslt == "2") {
						swal("Update!", $stats + ' ' + upmsg, "green", "btn-green");
						$("#" + $acts)[0].reset();
						$(location).attr('href', $lodlnk);
					}
					else if (response.rslt == "3") {
						swal("Failure!", $stats + ' ' + exsmsg, "orange", "btn-orange");
					}
					else if (response.rslt == "4") {
						swal("Failure!", $stats + ' ' + reqmsg, "orange", "btn-orange");
					}
					else {
						swal("Failure!", othmsg, "orange", "btn-orange");
					}

					unloading();
					$("button").attr('disabled', false);

				}
			});
		}
	}
	//Save data to db all page common function - END	

	//Active / inactive change all page common function - START
	function funchangestatus(t, $frm, $par) {
		$.confirm({
			title: 'Are you sure?',
			content: 'Sure you want to change the status?',
			type: "orange",
			btnClass: "btn-orange",
			buttons: {
				tryAgain: {
					text: 'Confirm',
					btnClass: 'btn-orange',
					action: function () {
						$.ajax({
							url: $frm,
							method: 'POST',
							dataType: 'json',
							data: $par,
							beforeSend: function () {
								loading();
							},
							success: function (response) {
								unloading();
								if (response.rslt == '6') {
									swal("Success!", statusmsg, "green", "btn-green");
									datatblCal(dataGridHdn);
								}
								else if (response.rslt == '7') {
									swal("Failure!", exsmsg_refstats, "orange", "btn-orange");
								}
								else {
									swal("Failure!", othmsg, "orange", "btn-orange");
								}
							}
						});
					}
				},
				cancel: function () {
					// $.alert('Canceled!');
				}
			}
		});
	}
	//Active / inactive change all page common function - END

	//Delete data all page common function - START
	function funStats(t, $frm, $par) {

		$.confirm({
			title: 'Are you sure?',
			content: 'You will not be able to recover this details',
			type: "orange",
			btnClass: "btn-orange",
			buttons: {
				tryAgain: {
					text: 'Yes, delete it!',
					btnClass: 'btn-orange',
					action: function () {
						$.ajax({
							url: $frm,
							method: 'POST',
							dataType: 'json',
							data: $par,
							beforeSend: function () {
								loading();
							},
							success: function (response) {
								unloading();
								if (response.rslt == '5') {
									swal("Success!", delmsg, "green", "btn-green");
									datatblCal(dataGridHdn);
								}
								else if (response.rslt == '7') {
									swal("Failure!", exsmsg_refstats, "orange", "btn-orange");
								}
							}
						});
					}
				},
				cancel: function () {
					// $.alert('Canceled!');
				}
			}
		});
	}

	//Delete data all page common function - END

	//Cancel all page common function - START	 
	function funCancel($frm, $acts, $stats, $lodlnk) {
		$.confirm({
			title: 'Are you sure?',
			content: 'Are you sure to cancel?',
			type: "orange",
			btnClass: "btn-orange",
			buttons: {
				tryAgain: {
					text: 'Confirm',
					btnClass: 'btn-orange',
					action: function () {
						$("#" + $acts)[0].reset();
						$(location).attr('href', $lodlnk);
					}
				},
				cancel: function () {
					// $.alert('Canceled!');
				}
			}
		});
	}

	//Save data to db all page common function - START		
	function funSubmtWithImg($frm, $urll, $acts, $stats, $lodlnk) {
		var acounts = '';
		var acounts1 = '';
		$('#' + $acts).parsley().validate();
		if ($('#' + $acts).parsley().isValid()) {
			$("button").attr('disabled', true);



			var m_data = new FormData();

			//alert($frm);

			var formdatas = $("#" + $acts).serializeArray();

			$.each(formdatas, function (key, value) {
				m_data.append(value.name, value.value);
				if (value.name == 'inpcou') {
					acounts = Number(value.value);
				}

				if (value.name == 'inpcouatt') {

					acounts1 = Number(value.value);
				}
			});


			if ($stats == 'user') {
				m_data.append('user_photo', $('input[name=user_photo]')[0].files[0]);
			}

			if ($frm == 'frmnewsevents') {

				var shortdescription = tinyMCE.get("elm1").getContent({ format: 'html' });

				var content = tinyMCE.get("elm2").getContent({ format: 'html' });

				m_data.append('newsdesc', content);
				m_data.append('short_desc', shortdescription);
				m_data.append('newsimage', $('input[name=newsimage]')[0].files[0]);

			}

			if ($frm == 'frmnewseventscat') {

				var shortdescription = tinyMCE.get("elm1").getContent({ format: 'html' });

				var content = tinyMCE.get("elm2").getContent({ format: 'html' });

				m_data.append('newscatdesc', content);

				m_data.append('short_desc', shortdescription);

				var _URL = window.URL || window.webkitURL;
				var file, img;
				var image = $('input[name=cat_image]')[0].files[0];
				img = new Image();
				var objectUrl = _URL.createObjectURL(image);
				img.onload = function () {
					if (this.width != 767 || this.height != 300) {
						alert('Image dimension should be 300x300');
						return false;
					}
					else {
						m_data.append('cat_image', $('input[name=cat_image]')[0].files[0]);
					}
				};
				img.src = objectUrl;
			}

			if ($frm == 'frmgallerycategories') {

				var specfic = tinyMCE.get("elm1").getContent({ format: 'html' });

				var content = tinyMCE.get("elm2").getContent({ format: 'html' });

				m_data.append('gallerycatdesc', content);
				m_data.append('specfic', specfic);
				m_data.append('image', $('input[name=image]')[0].files[0]);
			}

			if ($frm == 'gallerycategory') {

				var content = tinyMCE.activeEditor.getContent({ format: 'html' });
				m_data.append('gallerycatdesc', content);

			}

			if ($frm == 'frmtestimonial') {

				var content = tinyMCE.activeEditor.getContent({ format: 'html' });
				m_data.append('describtion', content);
				m_data.append('testimonial_image', $('input[name=testimonial_image]')[0].files[0]);

			}
			if ($frm == 'frmcareer') {

				//var content = tinyMCE.activeEditor.getContent({ format: 'html' });

				var content = 'Gun';
				m_data.append('careerdesc', content);

			}





			if ($frm == 'frmgallery') {

				m_data.append('galleryimage', $('input[name=galleryimage]')[0].files[0]);

			}

			if ($stats == 'gallerymoretimage') {
				var fileInput = document.getElementById("gallerymoreimage");
				var message = "";
				if ('files' in fileInput) {
					if (fileInput.files.length == 0) {
						message = "Please browse for one or more files.";
					} else {
						for (var i = 0; i < fileInput.files.length; i++) {
							message += "<br /><b>" + (i + 1) + ". file</b><br />";
							var file = fileInput.files[i];
							m_data.append('gallerymoreimage[]', file);
						}
					}
				}
			}
			if ($frm == 'frmnoticeboard') {
				m_data.append('pdf', $('input[name=pdf]')[0].files[0]);
			}

			if ($frm == 'frmstaff') {

				var content = tinyMCE.activeEditor.getContent({ format: 'html' });
				m_data.append('description', content);
				m_data.append('image', $('input[name=image]')[0].files[0]);

			}

			if ($frm == 'frmannounce') {
				m_data.append('pdf', $('input[name=pdf]')[0].files[0]);
			}

			if ($stats == 'profile') {
				m_data.append('user_photo', $('input[name=user_photo]')[0].files[0]);
			}


			if ($frm == 'frmspec') {
				var content = tinyMCE.activeEditor.getContent({ format: 'html' });
				m_data.append('description', content);
			}

			$.ajax({
				url: $urll,
				type: 'POST',
				dataType: 'json',
				processData: false,
				contentType: false,
				data: m_data,
				beforeSend: function () {
					loading();
					//	$("button").attr('disabled',false); 
				},
				success: function (response) {
					unloading();
					if (response.rslt == "1") {
						swal("Success!", $stats + ' ' + sucmsg, "green", "btn-green");
						$("#" + $acts)[0].reset();
						$(location).attr('href', $lodlnk);
					}
					else if (response.rslt == "2") {
						swal("Update!", $stats + ' ' + upmsg, "green", "btn-green");
						$("#" + $acts)[0].reset();
						$(location).attr('href', $lodlnk);
					}
					else if (response.rslt == "3") {
						swal("Failure!", $stats + ' ' + exsmsg, "orange", "btn-orange");
					}
					else if (response.rslt == "4") {
						swal("Failure!", $stats + ' ' + reqmsg, "orange", "btn-orange");
					}
					else if (response.rslt == "8") {
						swal("Failure!", $stats + ' ' + response.msg, "orange", "btn-orange");
						/*if($stats == 'product'){
								$("#product_images").val("");
							$('.jFiler-items jFiler-row').html('');
							$( "div" ).remove( ".jFiler-row" );
							}*/
					}
					else {
						swal("Failure!", othmsg, "orange", "btn-orange");
					}

					$("button").attr('disabled', false);

				}
			});
		}
	}

	$(document).ready(function () {

		var hheight = $("header").height();
		$("#dummyheader").height(hheight + 15);


		$('.maxlength').maxlength({
			alwaysShow: true,
			warningClass: "label label-success",
			limitReachedClass: "label label-danger"
		});

	});

	jQuery('.datepicker').datepicker({
		autoclose: true,
		todayHighlight: true,
		format: "dd-mm-yyyy"

	});

	jQuery('.date-range').datepicker({
		toggleActive: true,
		format: "dd-mm-yyyy",
		autoclose: true
	});

</script>

<!-- <script>
	$(document).ready(function () {

		tinymce.init({
			selector: 'textarea#elm2'
		});
	});

</script> -->