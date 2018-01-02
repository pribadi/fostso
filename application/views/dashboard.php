<style type="text/css">
	#container1, #container2, #container3, #container4, #container5 {
		min-width: 310px;
		max-width: 1000px;
		height: 400px;
		margin: 0 auto;
	}
</style>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<?php
	foreach ($dccrac1 as $dc1) {
		$humdc1[] = $dc1['humidity'];
		$temdc1[] = $dc1['temperature'];
		$top[] = 28;
		$bottom[] = 18;
	}
	foreach ($dccrac2 as $dc2) {
		$temdc2[] = $dc2['temperature'];
	} 
	foreach ($dccrac3 as $dc3) {
		$temdc3[] = $dc3['temperature'];
	}
	foreach ($dccrac4 as $dc4) {
		$temdc4[] = $dc4['temperature'];
	}
	foreach ($poweracrac1 as $pwra1) {
		$tempwra1[] = $pwra1['temperature'];
	}
	foreach ($poweracrac2 as $pwra2) {
		$tempwra2[] = $pwra2['temperature'];
	} 
	foreach ($powerbcrac1 as $pwrb1) {
		$tempwrb1[] = $pwrb1['temperature'];
	}
	foreach ($batteryacrac1 as $batta1) {
		$tembatta1[] = $batta1['temperature'];
	}
	foreach ($batteryacrac2 as $batta2) {
		$tembatta2[] = $batta2['temperature'];
	}
	foreach ($batterybcrac1 as $battb1) {
		$tembattb1[] = $battb1['temperature'];
	}

	foreach ($lvmdp as $lv) {
		
		$loadlv[] = $lv['kva'];
	}
	foreach ($cosa as $csa) {
		$loadcosa[] = $csa['kva'];
	}
	foreach ($mdpa as $mda) {
		$loadmdpa[] = $mda['kva'];
	}
 ?>

<div class="content-wrapper">
  <section class="content-header">
	    <div class="row">
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	        </ol>
	        <div class="col-xs-12">
		        <div class="box box-primary">
                    <div class="box-header">
                    <?php 
                    	// echo $year;
                     ?>
					    <div id="container1"></div>
					    <br>
					    <br>

					    <div id="container2"></div>
					    <br>

					    <div id="container3"></div>
					    <br>

					    <div id="container4"></div>
					    <br>

					    <div id="container5"></div>
					    <br>

				   </div>
			   </div>
	        </div>
	    </div>

    
    </section>
</div>

<script type="text/javascript">
	Highcharts.chart('container1', {

	    title: {
	        text: 'Daily Cooling Crac Work Checklist, <?php echo $namabulan .' '.$year; ?>'
	    },

	    subtitle: {
	        text: 'Facility Operation Support TSO'
	    },

	    yAxis: {
	        title: {
	            text: 'Temperature'
	        }
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        series: {
	            label: {
	                connectorAllowed: false
	            },
	            pointStart: 1
	        }
	    },

	    series: [{
		    name: 'DC 1',
	        data: [<?php echo join($temdc1, ',') ?>],
	    }, {
		    name: 'DC 2',
	        data: [<?php echo join($temdc2, ',') ?>],
	    }, {
	    	name: 'DC 3',
	        data: [<?php echo join($temdc3, ',') ?>],
	    }, {
	    	name: 'DC 4',
	        data: [<?php echo join($temdc4, ',') ?>],
	    }, {
	    	name: 'Power A 1',
	        data: [<?php echo join($tempwra1, ',') ?>],
	    }, {
	    	name: 'Power B 1',
	        data: [<?php echo join($tempwrb1, ',') ?>],
	    }, {
	    	name: 'Power A 2',
	        data: [<?php echo join($tempwra2, ',') ?>],
	    }, {
	    	name: 'Battery A 1',
	        data: [<?php echo join($tembatta1, ',') ?>],
	    }, {
	    	name: 'Battery A 2',
	        data: [<?php echo join($tembatta2, ',') ?>],
	    }, {
	        name: 'Battery B 1',
	        data: [<?php echo join($tembattb1, ',') ?>],
	    }],

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 800
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});

	Highcharts.chart('container2', {

	    title: {
	        text: 'Daily Load Electrical Work Checklist, <?php echo $namabulan .' '.$year; ?>'
	    },

	    subtitle: {
	        text: 'Facility Operation Support TSO'
	    },

	    yAxis: {
	        title: {
	            text: 'Load ( kva )'
	        }
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        series: {
	            label: {
	                connectorAllowed: false
	            },
	            pointStart: 1
	        }
	    },

	    series: [{
		    name: 'Maksimal',
	        data: [<?php echo join($top, ',') ?>],
	    }, {
		    name: 'Temperature',
	        data: [<?php echo join($temdc1, ',') ?>],
	    }, {
	    	name: 'Minimal',
	        data: [<?php echo join($bottom, ',') ?>],
	    // }, {
	    // 	name: 'DC CRAC 4',
	    //     data: [<?php echo join($temdc4, ',') ?>],
	    // }, {
	    // 	name: 'Power A CRAC 1',
	    //     data: [<?php echo join($tempwra1, ',') ?>],
	    // }, {
	    // 	name: 'Power B CRAC 1',
	    //     data: [<?php echo join($tempwrb1, ',') ?>],
	    // }, {
	    // 	name: 'Power A CRAC 2',
	    //     data: [<?php echo join($tempwra2, ',') ?>],
	    // }, {
	    // 	name: 'Battery A CRAC 1',
	    //     data: [<?php echo join($tembatta1, ',') ?>],
	    // }, {
	    // 	name: 'Battery A CRAC 2',
	    //     data: [<?php echo join($tembatta2, ',') ?>],
	    // }, {
	    //     name: 'Battery B CRAC 1',
	    //     data: [<?php echo join($tembattb1, ',') ?>],
	    }],

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});

	Highcharts.chart('container3', {

	    title: {
	        text: 'Daily Cooling Crac Work Checklist, <?php //echo $namabulan .' '.$year; ?>'
	    },

	    subtitle: {
	        text: 'Facility Operation Support TSO'
	    },

	    yAxis: {
	        title: {
	            text: 'Number of Employees'
	        }
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        series: {
	            label: {
	                connectorAllowed: false
	            },
	            pointStart: 1
	        }
	    },

	    series: [{
	        name: 'Installation',
	        data: [20, 21, 22, 23, 24, 25, 26, 27]
	    }, {
	        name: 'Manufacturing',
	        data: [30, 20, 30, 20, 30, 20, 30, 20]
	    }, {
	        name: 'Sales & Distribution',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	        name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	        name: 'Other',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }],

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});

	Highcharts.chart('container4', {

	    title: {
	        text: 'Daily Cooling Crac Work Checklist, <?php //echo $namabulan .' '.$year; ?>'
	    },

	    subtitle: {
	        text: 'Facility Operation Support TSO'
	    },

	    yAxis: {
	        title: {
	            text: 'Number of Employees'
	        }
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        series: {
	            label: {
	                connectorAllowed: false
	            },
	            pointStart: 1
	        }
	    },

	    series: [{
	        name: 'Installation',
	        data: [20, 21, 22, 23, 24, 25, 26, 27]
	    }, {
	        name: 'Manufacturing',
	        data: [30, 20, 30, 20, 30, 20, 30, 20]
	    }, {
	        name: 'Sales & Distribution',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	        name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	        name: 'Other',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }],

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});

	Highcharts.chart('container5', {

	    title: {
	        text: 'Daily Cooling Crac Work Checklist, <?php //echo $namabulan .' '.$year; ?>'
	    },

	    subtitle: {
	        text: 'Facility Operation Support TSO'
	    },

	    yAxis: {
	        title: {
	            text: 'Number of Employees'
	        }
	    },
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    plotOptions: {
	        series: {
	            label: {
	                connectorAllowed: false
	            },
	            pointStart: 1
	        }
	    },

	    series: [{
	        name: 'Installation',
	        data: [20, 21, 22, 23, 24, 25, 26, 27]
	    }, {
	        name: 'Manufacturing',
	        data: [30, 20, 30, 20, 30, 20, 30, 20]
	    }, {
	        name: 'Sales & Distribution',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	        name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	    	name: 'Project Development',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }, {
	        name: 'Other',
	        data: [20, 30, 40, 50, 60, 70, 80, 90]
	    }],

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});
</script>