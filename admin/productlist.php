<?php 
  require_once 'inc/header.php';
  require_once 'inc/sidebar.php';
  require_once '../classes/product.php';

  ?>
 <?php

   $Pd = new Product();
   $fm = new Format();
  
?>



     


<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block"> 
        	 <?php

			 if (isset($_GET['delpro'])) {
			 	$id = $_GET['delpro'];
			 	$id = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['delpro'] );
			 	$delpro = $Pd->delproById($id);
			 }

      if (isset($delpro)) {
           echo $delpro;
           }

        ?> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Sl</th>
					<th>Product name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
                  $getpd = $Pd->getAllProduct(); 
                  if ($getpd) {
                  	$i = 0;
                  	while($result = $getpd->fetch_assoc()){
                    $i++;
                 
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['catname'];?></td>
					<td><?php echo $result['brandName'];?></td>
					<td><?php echo $fm->textShorten($result['body'],50);?></td>
					<td>$<?php echo $result['price'];?></td>
					<td><img src="<?php echo $result['image'];?>" alt="" height="40px" width="60px"></td>
					<td>
						<?php
						if ($result['type'] ==0) {
							echo "Featured";
						}else{
							echo "General";
						}

						?>
							
						</td>
					<td><a href="productedit.php?proid=<?php echo $result['productid'];?>">Edit</a> || <a onclick="return confirm('Are your sure to delete')" href="?delpro=<?php echo $result['productid'];?>">Delete</a></td>
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
