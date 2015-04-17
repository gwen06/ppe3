<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-Type" content="tect/html; charget=UTF-8" />
		<title>Calendrier</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		</head>
	<body>
		<?php
		require ('date.php') ;
		$date = new Date() ;
		$year = date('Y');
		$dates = $date->getAll($year) ;
		?>
		<div class="periods">
			<div class="year"> <?php echo $year ?></div>
			<div class="months">
				<ul>
					<?php foreach ($date->months as $id=>$m): ?>
						<li><a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo utf8_encode(substr(utf8_encode($m),0,3)); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="clear"></div>
			<?php $dates = current ($dates); ?>
			<?php foreach ($dates as $m=>$days): ?>
				<div class="month relative" id="month<?php echo $m; ?>">
					<table>
						<thead>
							<tr>
								<?php foreach ($date->days as $d): ?>
									<th><?php echo substr($d,0,3); ?></th>
								<?php endforeach ?>
							</tr>
						</thead>
						<tbody>
							<tr>
								<?php $end = end($days); foreach ($days as $d => $w): ?>
								<?php if($d==1): ?>
									<td colspan="<?php echo $w-1; ?>" class="padding"></td>
								<?php endif; ?>
								<td>
									<div class="relative">
										<div class="day"><?php echo $d; ?></div>
									</div>
									<ul class="events">
										<li> Mon evenement </li>
									</ul>
								</td>
								<?php if($w == 7): ?>
							</tr>
							<tr>
								<?php endif; ?>
							<?php endforeach; ?>
							<?php if($end != 7): ?>
								<td colspan="<?php echo 7-$end; ?>" class="padding"></td>
							<?php endif; ?>
							</tr>
						</tbody>
					</table>
				</div>
			<?php endforeach; ?>
		</div>
		<pre><?php print_r($dates); ?></pre>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.month').hide();
				$('.month:first').show();
				$('.months a:first').addClass('active');
				var current =1;
				$('.months a').click(function() {
					var month = $(this).attr('id').replace('linkMonth','');
					if(month != current) {
						$('#month'+current).slideUp();
						$('#month'+month).slideDown();
						$('.month a').removeClass('active');
						$('.month a#linkMonth' +month).addClass('active');
						current = month;
					}
					return false;
				}) ;
			});
		</script>
<html>