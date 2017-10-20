

<div class="well">
	<div style="font-size:25px;font-weight:bold;text-align:center;">Total Purchase Amount</div>
</div>
<div class="row-fluid">
	<div class="well form-inline">
		<?php $today = date('Y-m-d'); ?>
		<form class="span7" method="post" action="<?=base_url()?>creport/search_report_by_date">
			<label class="select">From</label>
				<input type="text" name="from_date" value="<?php echo $today; ?>" data-date-format="yyyy-mm-dd" class="span4 datepicker"/>
			<label class="select">To</label>
				<input type="text" name="to_date" data-date-format="yyyy-mm-dd" class="span4 datepicker"/>
			<button type="submit" class="btn">Search by date</button>
		</form>
	</div>
</div>
<?php
if(!empty($todays_total_amount)){
?>
<table class="table table-striped table-condensed table-bordered">
	<thead>
		<tr>
			<th><?php echo ucfirst(convert_number_to_words($todays_total_amount)); ?> Taka only.</th>
			<th>{todays_total_amount} Tk.</th>
		</tr>
	</thead>
</table>

<?php
}else{
?>
<div class="NoDataFound"><center>No Data Found</center></div>
<?php
}
?>
