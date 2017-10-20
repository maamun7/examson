<?php
if(!empty($purchase_report)){
?>
<table class="table table-striped table-condensed table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Purchase No</th>
			<th>Supplier Name</th>
			<th>Authorised By</th>
			<th>Amount</th>
			<th>Details</th>
		</tr>
	</thead>
	<tbody>
	{purchase_report}
		<tr>
			<td>{sl}</td>
			<td>{chalan_no}</td>
			<td>
				<a href="<?php echo base_url().'csupplier/supplier_details/{supplier_id}'; ?>">
					{supplier_name}
				</a>
			</td>
			<td>{authorised_p_name}</td>
			<td>{final_total} Tk.</td>
			<td>
				<a href="<?php echo base_url().'cpurchase/purchase_details_data/{purchase_id}'; ?>"> View </a>
			</td>
		</tr>
	{/purchase_report}
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4" style="text-align:right;font-weight:bold">Grand Total = </td>
			<td><b>{todays_total} Tk.</b></td>
			<td></td>
		</tr>
	</tfoot>
</table>
<div id="pagin"><center><?php if(isset($links)){echo $links;} ?></center></div>
<?php
}else{
?>
<div class="NoDataFound"><center>No Data Found</center></div>
<?php
}
?>
