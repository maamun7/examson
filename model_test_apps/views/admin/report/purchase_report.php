<h2>Purchase Report</h3>
<?php $today = date('Y-m-d'); ?>
	<div class="row-fluid">
		<div>
			<form class="well form-inline" method="post" action="<?=base_url()?>creport/retrieve_dateWise_PurchaseReports">
				<label class="select">Search By Date: From</label>
					<input type="text" name="from_date"  value="<?php echo $today; ?>" data-date-format="yyyy-mm-dd" class="datepicker"/>
				<label class="select">To</label>
					<input type="text" name="to_date" data-date-format="yyyy-mm-dd" class="datepicker"/>
					<input type="hidden" class="autocomplete_hidden_value" name="product_id" id="SchoolHiddenId"/>
				<button type="submit" class="btn">Search</button>
			</form>
		</div>
	</div>
<?php
if(!empty($purchase_report)){
?>
<table class="table table-striped table-condensed table-bordered">
	<thead>
		<tr>
			<th>Sales Date</th>
			<th>Chalan No</th>
			<th>Chalan Details</th>
			<th>Supplier Name</th>
			<th>Total Amount</th>
		</tr>
	</thead>
	<tbody>
	{purchase_report}
		<tr>
			<td>{prchse_date}</td>
			<td>{chalan_no}</td>
			<td>
				<a href="<?php echo base_url().'cpurchase/purchase_details_data/{purchase_id}'; ?>">
					Details
				</a>
			</td>
			<td>{supplier_name}</td>
			<td>{grand_total_amount}</td>
		</tr>
	{/purchase_report}
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">&nbsp;</td>
			<td><b>{purchase_amount}</b></td>
		</tr>
	</tfoot>
</table>

<?php
}else{
?>
<div class="NoDataFound"><center>No Data Found</center></div>
<?php
}
?>