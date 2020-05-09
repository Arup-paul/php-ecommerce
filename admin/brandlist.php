<?php 
  require_once 'inc/header.php';
  require_once 'inc/sidebar.php';
  require_once '../classes/brand.php';
 ?>

 <?php
 $brand = new Brand(); 

 ?>

 <?php

 if (isset($_GET['delcat'])) {
 	$id = $_GET['delcat'];
 	$id = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['delcat'] );
 	$delcat = $brand->delCatById($id);
 }


 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block"> 
                <?php
               if(isset($delcat)){
               	echo $delcat;
               }

                ?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                          $getbrand = $brand->getAllCat();
                          if ($getbrand) {
                          	$i = 0;
                          	while ($result = $getbrand->fetch_assoc()){
                          		$i++;
                        
						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['brandName'];?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandid'];?>">Edit</a> || <a onclick="return confirm('Are your sure to delete')" href="?delcat=<?php echo $result['brandid'];?>">Delete</a></td>
						</tr>
					<?php } } ?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

