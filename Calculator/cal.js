$.noConflict();

jQuery(document).ready(function(){
	var display = document.getElementById('display');
	var hasEvaluated = false;

	// 	check if 0 is present. if it is, override it, else append value to display
	function clickNumbers(val)
	{
		if (display.innerHTML === '0' || (hasEvaluated === true && !isNaN(display.innerHTML))) 
		{
			display.innerHTML = val;
		}
		else
		{
			display.innerHTML += val;
		}
		hasEvaluated = false;
	}

	// plus minus
	jQuery('#plus_minus').click(function(){
		if (eval(display.innerHTML) > 0) 
		{
			display.innerHTML = '-' + display.innerHTML;
		}
		else
		{
			display.innerHTML = display.innerHTML.replace('-', '');
		}
	});

	// clear value
	jQuery("button#clear").click(function(){
		display.innerHTML = '0';
		jQuery('p#display').css('font-size', '20px');
	});

	jQuery("#one").click(function(){
		checkLength(display.innerHTML);
		clickNumbers(1);
	});

	jQuery('#two').click(function(){
		checkLength(display.innerHTML);
		clickNumbers(2);
	});

	jQuery('#three').click(function(){
		checkLength(display.innerHTML);
		clickNumbers(3);
	});

	jQuery('#four').click(function(){
		checkLength(display.innerHTML);
		clickNumbers(4);
	});

	jQuery('#five').click(function(){
		checkLength(display.innerHTML);
		clickNumbers(5);
	});

	jQuery('#six').click(function(){
		checkLength(display.innerHTML);
		clickNumbers(6);
	});

	jQuery('#seven').click(function(){
		checkLength(display.innerHTML);
		clickNumbers(7);
	});

	jQuery('#eight').click(function(){
		checkLength(display.innerHTML);
		clickNumbers(8);
	});

	jQuery('#nine').click(function(){
		checkLength(display.innerHTML);
		clickNumbers(9);
	});

	jQuery('#zero').click(function(){
		checkLength(display.innerHTML);
		clickNumbers(0);
	});

	jQuery('#decimal').click(function(){
		if (display.innerHTML.indexOf('.') === -1 ||
	      (display.innerHTML.indexOf('.') !== -1 && display.innerHTML.indexOf('+') !== -1) ||
	      (display.innerHTML.indexOf('.') !== -1 && display.innerHTML.indexOf('-') !== -1) ||
	      (display.innerHTML.indexOf('.') !== -1 && display.innerHTML.indexOf('×') !== -1) ||
	      (display.innerHTML.indexOf('.') !== -1 && display.innerHTML.indexOf('÷') !== -1)) {
	      clickNumbers('.')
	    }
	});

	// operator
	jQuery('#plus').click(function(){
		evaluate();
		checkLength(display.innerHTML);
		display.innerHTML += '+';
	});

	jQuery('#minus').click(function(){
		evaluate();
		checkLength(display.innerHTML);
		display.innerHTML += '-';
	});

	jQuery('#multiply').click(function(){
		evaluate();
		checkLength(display.innerHTML);
		display.innerHTML += 'x';
	});

	jQuery('#divison').click(function(){
		evaluate();
		checkLength(display.innerHTML);
		display.innerHTML += '÷';
	});

	jQuery('#squar').click(function(){
		var num = Number(display.innerHTML);
		num = num * num;
		checkLength(num);
		display.innerHTML = num;
	});

	jQuery('#sqrt').click(function(){
		var num = parseFloat(display.innerHTML);
		num = Math.sqrt(num);
		display.innerHTML = Number(num.toFixed(5));
	});

	jQuery('#equal').click(function(){
		evaluate();
		hasEvaluated = true;
	});

	// eval function 
	function evaluate()
	{
		display.innerHTML = display.innerHTML.replace(",", "");
		display.innerHTML = display.innerHTML.replace("x", "*");
		display.innerHTML = display.innerHTML.replace("÷", "/");
		if (display.innerHTML.indexOf('/0') !== -1) 
		{
			alert('Undefined Value'); 
		}
		var evaluate = eval(display.innerHTML);
		if (evaluate.toString().indexOf('.') != -1) 
		{
			evaluate  = evaluate.toFixed(5);
		}
		checkLength(evaluate);
		display.innerHTML = evaluate;
	}

	// check length and disabled button
	function checkLength(num)
	{
		if (num.toString().length > 7 && num.toString().lenght < 14) 
		{
			$('p#display').css('font-size', '14px');
		}
		else if (num.toString().length > 16) 
		{
			num = "Infinity";
		}

	}

});