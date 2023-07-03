<div class="page-top">
	<div class="page-top-left">
		<h1><?php echo $_SESSION['company']; ?> - Inventory & Billing System</h1>
	</div>
	<div class="page-top-right">
		<h1>24x7 Support | +91 9944033729<h1>
	</div>
</div>
<div class="page-header">
				<div class="page-header-left">
					<div class="menu">
					<ul>
						<li class="dropmain"><a href="dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
							
						</li>
						<li class="dropmain"><i class="fa fa-cog" aria-hidden="true"></i> Setup
							<ul class="dropmenu">
							<li><a href="company.php"><i class="fa fa-building-o" aria-hidden="true"></i> Company</a></li>
							<li><a href="user.php"><i class="fa fa-user" aria-hidden="true"></i> User</a></li>
							<!--<li><a href="template.php"><i class="fa fa-columns" aria-hidden="true"></i> Template</a></li>-->
							</ul>
						</li>
						<li class="dropmain"><i class="fa fa-database" aria-hidden="true"></i> Master
							<ul class="dropmenu">
								<li><a href="supplier.php"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Supplier</li>
								<li><a href="brand.php"><i class="fa fa-black-tie"></i>&nbsp;&nbsp;Brand</a></li>
								<li><a href="category.php"><i class="fa fa-list-alt" aria-hidden="true"></i> Category</li>
								<li><a href="item.php"><i class="fa fa-bitbucket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Item</li>
								<li><a href="customer.php"><i class="fa fa-users" aria-hidden="true"></i> Client</li>
								<li><a href="tax.php"><i class="fa fa-percent" aria-hidden="true"></i>&nbsp;&nbsp;Tax</a></li>
							</ul>
						</li>
						
						<li class="dropmain"><i class="fa fa-bar-chart" aria-hidden="true"></i> Stock
							<ul class="dropmenu">
								<li><a href="stock.php">New Stock</a></li>
								<li><a href="damagedstock.php">Damaged Stock</a></li>
								
							</ul>
						</li>
						
						<li class="dropmain"><i class="fa fa-cart-plus" aria-hidden="true"></i> Order
							<ul class="dropmenu">
							<li><a href="neworder.php"><i class="fa fa-plus" aria-hidden="true"></i> New Order</a></li>
							<li><a href="order.php"><i class="fa fa-eye" aria-hidden="true"></i> Manage Order</a></li>
							</ul>
						</li>
						
						<li class="dropmain"><i class="fa fa-bar-chart" aria-hidden="true"></i> Report
							<ul class="dropmenu">
								<li><a href="report-stock.php">Stock Report</a></li>
								<li><a href="report-damage-stock.php">Stock Damage Report</a></li>
								<li><a href="report-sales.php">Sales Report</a></li>
								<li><a href="report-profit.php">Profit Report</a></li>
								<li><a href="report-payment.php">Payment Report</a></li>
								<li><a href="report-pending.php">Pending Report</a></li>
								<li><a href="report-tax.php">Tax Report</a></li>
								<li><a href="report-audit.php">Auditing</a></li>
							</ul>
						</li>
					</ul>
					</div>
				</div>
				<div class="page-header-right">
					<ul class="user">
						<li class="user-mainmenu"><i class="fa fa-user" aria-hidden="true"></i>
						</li>
					</ul>
					<ul class="user-submenu">
						
						<li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
					</ul>
				</div>
		</div>