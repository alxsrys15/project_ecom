<div class="container mt-5">
	<div class="row">
		<div class="col-sm-3">
            <?= $this->element('profile_sidebar') ?>
        </div>
        <div class="col-sm-9">
        	<div class="row">
        		<div class="col-sm-6">
        			<?php if (count($unassigned_list) > 0): ?>
        				<?= $this->Form->create(null, ['url' => ['action' => 'assignUser']]) ?>
        				<?= $this->Form->control('unassigned_id', ['type' => 'select', 'options' => $unassigned_list, 'class' => 'form-control']) ?>
        				<?= $this->Form->control('parent_id', ['type' => 'select', 'options' => $open_users, 'class' => 'form-control', 'label' => 'Assign to']) ?>
        				<button class="btn btn-primary" type="submit">Assign</button>
        				<?= $this->Form->end() ?>
        			<?php endif ?>
        		</div>
        		<div class="col-sm-12">
        			<div id="chart_div">
        		
        			</div>
        		</div>
        	</div>
        </div>
	</div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    const x = <?= json_encode($data) ?>;
    const threaded = <?= json_encode($q) ?>;
    let s = [];
    $.each(threaded, function (i, c1) {
    	s.push([c1.first_name, x.level_0.first_name, '']);
    	if (c1.children.length > 0) {
    		$.each(c1.children, function (i, c2) {
    			s.push([c2.first_name, c1.first_name, '']);
    			if (c2.children.length > 0) {
		    		$.each(c2.children, function (i, c3) {
		    			s.push([c3.first_name, c2.first_name, '']);
		    		});
		    	}
    		});
    	}
    });
  	google.charts.load('current', {packages:["orgchart"]});
  	google.charts.setOnLoadCallback(drawChart);
  	function drawChart() {
    	var data = new google.visualization.DataTable({size: 'large'});
    	data.addColumn('string', 'Name');
    	data.addColumn('string', 'Manager');
    	data.addColumn('string', 'ToolTip');

    	// For each orgchart box, provide the name, manager, and tooltip to show.
    	data.addRows([
      		[x.level_0.first_name, '', 'The President'],
      		...s
    	]);



    // Create the chart.
    	var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
    // Draw the chart, setting the allowHtml option to true for the tooltips.
    	chart.draw(data, {'allowHtml':true});
  	}
</script>
