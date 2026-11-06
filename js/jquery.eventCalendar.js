/* =
	jquery.eventCalendar.js
	version: 0.54
	date: 18-04-2013
	author:
		Jaime Fernandez (@vissit)
	company:
		Paradigma Tecnologico (@paradigmate)
*/

;$.fn.eventCalendar = function(options){

	var eventsOpts = $.extend({}, $.fn.eventCalendar.defaults, options);

	// define global vars for the function
	var flags = {
		wrap: "",
		directionLeftMove: "300",
		eventsJson: {}
	}

	// each eventCalendar will execute this function
	this.each(function(){

		flags.wrap = $(this);
		flags.wrap.addClass('eventCalendar-wrap').append("<div class='eventsCalendar-list-wrap'><p class='eventsCalendar-disponibles'></p><p class='eventsCalendar-subtitle'></p><span class='eventsCalendar-loading'>loading...</span><div class='eventsCalendar-list-content'><ul class='eventsCalendar-list'></ul></div></div>");

		if (eventsOpts.eventsScrollable) {
			flags.wrap.find('.eventsCalendar-list-content').addClass('scrollable');
		}

		setCalendarWidth();
		$(window).resize(function(){
			setCalendarWidth();
		});
		//flags.directionLeftMove = flags.wrap.width();

		// show current month
		dateSlider("current");

		getEvents(eventsOpts.eventsLimit,false,false,false,false);

		changeMonth();

		flags.wrap.on('click','.eventsCalendar-day a',function(e){
		//flags.wrap.find('.eventsCalendar-day a').live('click',function(e){
			e.preventDefault();
			var year = flags.wrap.attr('data-current-year'),
				month = flags.wrap.attr('data-current-month'),
				day = $(this).parent().attr('rel');

			getEvents(false, year, month,day, "day");
		});
		flags.wrap.on('click','.monthTitle', function(e){
		//flags.wrap.find('.monthTitle').live('click',function(e){
			e.preventDefault();
			var year = flags.wrap.attr('data-current-year'),
				month = flags.wrap.attr('data-current-month');

			getEvents(eventsOpts.eventsLimit, year, month,false, "month");
		})



	});


	function sortJson(a, b){
		return a.date.toLowerCase() > b.date.toLowerCase() ? 1 : -1;
	};

	function dateSlider(show, year, month) {
		var $eventsCalendarSlider = $("<div class='eventsCalendar-slider'></div>"),
			$eventsCalendarMonthWrap = $("<div class='eventsCalendar-monthWrap'></div>"),
			$eventsCalendarTitle = $("<div class='eventsCalendar-currentTitle'><a href='#' class='monthTitle'></a></div>"),
			$eventsCalendarArrows = $("<a href='#' class='arrow prev'><span>" + eventsOpts.txt_prev + "</span></a><a href='#' class='arrow next'><span>" + eventsOpts.txt_next + "</span></a>");
			$eventsCalendarDaysList = $("<ul class='eventsCalendar-daysList'></ul>"),
			date = new Date();
			

		if (!flags.wrap.find('.eventsCalendar-slider').size()) {
			flags.wrap.prepend($eventsCalendarSlider);
			$eventsCalendarSlider.append($eventsCalendarMonthWrap);
		} else {
			flags.wrap.find('.eventsCalendar-slider').append($eventsCalendarMonthWrap);
		}

		flags.wrap.find('.eventsCalendar-monthWrap.currentMonth').removeClass('currentMonth').addClass('oldMonth');
		$eventsCalendarMonthWrap.addClass('currentMonth').append($eventsCalendarTitle, $eventsCalendarDaysList);



		// if current show current month & day
		if (show === "current") {
			day = date.getDate();
			$eventsCalendarSlider.append($eventsCalendarArrows);

		} else {
			date = new Date(flags.wrap.attr('data-current-year'),flags.wrap.attr('data-current-month'),1,0,0,0); // current visible month
			day = 0; // not show current day in days list

			moveOfMonth = 1;
			if (show === "prev") {
				moveOfMonth = -1;
			}
			date.setMonth( date.getMonth() + moveOfMonth );

			var tmpDate = new Date();
			if (date.getMonth() === tmpDate.getMonth()) {
				day = tmpDate.getDate();
			}

		}

		// get date portions
		var year = date.getFullYear(), // year of the events
			currentYear = (new Date).getFullYear(), // current year
			month = date.getMonth(), // 0-11
			monthToShow = month + 1;

		if (show != "current") {
			// month change
			getEvents(eventsOpts.eventsLimit, year, month,false, show);
		}

		flags.wrap.attr('data-current-month',month)
			.attr('data-current-year',year);

		// add current date info
		$eventsCalendarTitle.find('.monthTitle').html(eventsOpts.monthNames[month] + " " + year);

		// print all month days
		var daysOnTheMonth = 32 - new Date(year, month, 32).getDate();
		var daysList = [];
		if (eventsOpts.showDayAsWeeks) {
			$eventsCalendarDaysList.addClass('showAsWeek');

			// show day name in top of calendar
			if (eventsOpts.showDayNameInCalendar) {
				$eventsCalendarDaysList.addClass('showDayNames');

				var i = 0;
				// if week start on monday
				if (eventsOpts.startWeekOnMonday) {
					i = 1;
				}

				for (; i < 7; i++) {
					daysList.push('<li class="eventsCalendar-day-header">'+eventsOpts.dayNamesShort[i]+'</li>');

					if (i === 6 && eventsOpts.startWeekOnMonday) {
						// print sunday header
						daysList.push('<li class="eventsCalendar-day-header">'+eventsOpts.dayNamesShort[0]+'</li>');
					}

				}
			}

			dt=new Date(year, month, 01);
			var weekDay = dt.getDay(); // day of the week where month starts

			if (eventsOpts.startWeekOnMonday) {
				weekDay = dt.getDay() - 1;
			}
			if (weekDay < 0) { weekDay = 6; } // if -1 is because day starts on sunday(0) and week starts on monday
			for (i = weekDay; i > 0; i--) {
				daysList.push('<li class="eventsCalendar-day empty"></li>');
			}
		}
		for (dayCount = 1; dayCount <= daysOnTheMonth; dayCount++) {
			var dayClass = "";

			if (day > 0 && dayCount === day && year === currentYear) {
				dayClass = "today";
			}
			//alert(dayCount);
			//daysList.push('<li id="dayList_' + dayCount + '" rel="'+dayCount+'" class="eventsCalendar-day '+dayClass+'"><a href="#">' + dayCount + '</a></li>');
			//var msec = Date.parse(year+"/"+month+"/"+dayCount);
			var d = new Date(year,month,dayCount);
			
					
				//alert($("#clave_estudio").val());
				if($("#clave_estudio").val()==="45"){
					if(d.getDay()==1 || d.getDay()==2 || d.getDay()==3 || d.getDay()==5 || d.getDay()==4){
				
						//flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(dayCount)).addClass('dayWithoutEventsSunday');
						daysList.push('<li id="dayList_' + dayCount + '" rel="'+dayCount+'" class="eventsCalendar-day dayWithoutEventsSunday'+dayClass+'"><a href="#">' + dayCount + '</a></li>');
					}else{
						daysList.push('<li id="dayList_' + dayCount + '" rel="'+dayCount+'" class="eventsCalendar-day '+dayClass+'"><a href="#">' + dayCount + '</a></li>');
						
					}
					
				}else{
					if(d.getDay()==0 || d.getDay()==6){
						//flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(dayCount)).addClass('dayWithoutEventsSunday');
						
						daysList.push('<li id="dayList_' + dayCount + '" rel="'+dayCount+'" class="eventsCalendar-day dayWithoutEventsSunday'+dayClass+'"><a href="#">' + dayCount + '</a></li>');
					}else{
						daysList.push('<li id="dayList_' + dayCount + '" rel="'+dayCount+'" class="eventsCalendar-day '+dayClass+'"><a href="#">' + dayCount + '</a></li>');
						
					}
				}
		}
		$.getJSON('servicios/consultarDiasDescansoGeneral.php', function(data) {	
			var anio=year;
			var mes=month+1;			
					for(var i = 0; i < data.length; i++) { 					
						if(anio==data[i].anio && mes==data[i].mes){							
							flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(data[i].dia)).addClass('dayWithoutEventsSunday');
						}
					}
			});
			
		$.getJSON('servicios/consultarDiasDescansoPersonal.php?personal='+$("#clave_personal").val(), function(data) {	
			var anio=year;
			var mes=month+1;			
					for(var i = 0; i < data.length; i++) { 					
						if(anio==data[i].anio && mes==data[i].mes){							
							flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(data[i].dia)).addClass('dayWithoutEventsPermiso');
						}
					}
			});
			
			
		$eventsCalendarDaysList.append(daysList.join(''));

		$eventsCalendarSlider.css('height',$eventsCalendarMonthWrap.height()+'px');
	}

	function num_abbrev_str(num) {
		var len = num.length, last_char = num.charAt(len - 1), abbrev
		if (len === 2 && num.charAt(0) === '1') {
			abbrev = ''
		} else {
			if (last_char === '1') {
				abbrev = ''
			} else if (last_char === '2') {
				abbrev = ''
			} else if (last_char === '3') {
				abbrev = ''
			} else {
				abbrev = ''
			}
		}
		return num + abbrev
	}

	function getEvents(limit, year, month, day, direction) {
		// alert(limit);
		// alert(year);
		// alert(month);
		// alert(day);
		// alert(direction);
		var limit = limit || 0;
		var year = year || '';
		var day = day || '';

		// to avoid problem with january (month = 0)

		if (typeof month != 'undefined') {
			var month = month;
		} else {
			var month = '';
		}

		//var month = month || '';
		flags.wrap.find('.eventsCalendar-loading').fadeIn();

		if (eventsOpts.jsonData) {
			// user send a json in the plugin params
			eventsOpts.cacheJson = true;

			flags.eventsJson = eventsOpts.jsonData;
			getEventsData(flags.eventsJson, limit, year, month, day, direction);

		} else if (!eventsOpts.cacheJson || !direction) {
			// first load: load json and save it to future filters
			$.getJSON(eventsOpts.eventsjson + "&limit="+limit+"&year="+year+"&month="+month+"&day="+day, function(data) {
				flags.eventsJson = data; // save data to future filters
				getEventsData(flags.eventsJson, limit, year, month, day, direction);
			}).error(function() {
				showError("error getting json: ");
			});
		} else {
			// filter previus saved json
			getEventsData(flags.eventsJson, limit, year, month, day, direction);
		}

		if (day > '') {
			flags.wrap.find('.current').removeClass('current');
			flags.wrap.find('#dayList_'+day).addClass('current');
		}
	}

	function getEventsData(data, limit, year, month, day, direction){
		directionLeftMove = "-=" + flags.directionLeftMove;
		eventContentHeight = "auto";

		subtitle = flags.wrap.find('.eventsCalendar-list-wrap .eventsCalendar-subtitle')
		
		if (!direction) {
			// first load
			subtitle.html(eventsOpts.txt_NextEvents);
			eventContentHeight = "auto";
			directionLeftMove = "-=0";
		} else {
			if (day != '') {
				subtitle.html(eventsOpts.txt_SpecificEvents_prev + eventsOpts.monthNames[month] + " " + num_abbrev_str(day) + " " + eventsOpts.txt_SpecificEvents_after);
				var disponibles = flags.wrap.find('.eventsCalendar-list-wrap .eventsCalendar-disponibles')
				disponibles.html("");
				var fecha=date.getFullYear()+"-"+(parseInt(month)+1)+ "-" + num_abbrev_str(day);
				$("#dia").val(day);
				$("#mes").val(month);
				$("#anio").val(date.getFullYear());
				$("#fecha_cita").val(fecha);	
				var d = new Date();	
				var dia=d.getUTCDate();
				var ano=d.getUTCFullYear();
				var mes=d.getUTCMonth() + 1;
				var month1=parseInt(month)+1;
//para agendar fechas pasadas
				var fechaini = new Date('2021-01-01');
				var fechafin = new Date(ano+"/"+mes+"/"+dia);
				var fechafinsel = new Date(year+"/"+month1+"/"+day);
				var diasdif= fechafin.getTime()-fechaini.getTime();
				var diasdifsel= fechafinsel.getTime()-fechaini.getTime();
				var contdias = Math.round(diasdif/(1000*60*60*24));
				var contdiassel = Math.round(diasdifsel/(1000*60*60*24));
				//alert(contdias);	
				//alert(contdiassel);				
				//contdiassel
				if(eventsOpts.txt_operacion=="registrar"){					
					/*alert(ano);
					alert(mes);
					alert(dia);
					alert(year);
					alert(month1);
					alert(day);*/
					
					/*para agendar fechas pasadas -contdias normal cambiar a -1 ajustetemporal
					if (year <= ano 
						&& month1 <= mes
						&& day < parseInt(dia)-1 ) {*/
						if(contdiassel<0){
							mostrarMensajePreventivo("No se puede agendar una cita en una fecha anterior a la fecha actual.",5);
							$('html,body').scrollTop(0);
							flags.wrap.find('.eventsCalendar-loading').hide();
							return;
						}
						
						var msec = Date.parse(year+"/"+month1+"/"+day);
						var d = new Date(msec);
						/*if(d.getDay()==0){
						mostrarMensajePreventivo("No se puede agendar una cita en domingo.",5);
							$('html,body').scrollTop(0);
							flags.wrap.find('.eventsCalendar-loading').hide();
							return;
						}*/
					
				}
				if(eventsOpts.txt_operacion=="eliminar"){
					var d = new Date();	
					
					var dia=d.getDay()+1;
					if (year <= ano 
						&& month1 <= mes
						&& day < dia) {
							mostrarMensajePreventivo("No se puede eliminar una cita de una fecha anterior a la fecha actual.",5);
							$('html,body').scrollTop(0);
							flags.wrap.find('.eventsCalendar-loading').hide();
							return;
						}						
				}
				$.getJSON('servicios/consultarHorariosEstudioFecha.php?clave_estudio='+$("#clave_estudio").val()+"&fecha_cita="+fecha+"&clave_paciente="+$("#clave_paciente").val(), function(data) {				
					if(data.length>0){
						disponibles.append("</br><h3>Horarios Disponibles para "+eventsOpts.monthNames[month] + " " + num_abbrev_str(day)+"</h3>")
					}else{
						disponibles.append("</br><h3>No hay horarios disponibles para "+eventsOpts.monthNames[month] + " " + num_abbrev_str(day)+"</h3>")
					}
					for(var i = 0; i < data.length; i++) { 
						disponibles.append("<input type='button' id='"+data[i].clave_horario_cita+"' value='"+data[i].hora+" Hrs.' class='button' onclick='asignarCita("+data[i].clave_horario_cita+")'/>")											
					}
				});
			} else {
				subtitle.html(eventsOpts.txt_SpecificEvents_prev + eventsOpts.monthNames[month] + " " + eventsOpts.txt_SpecificEvents_after);
			}

			if (direction === 'prev') {
				directionLeftMove = "+=" + flags.directionLeftMove;
			} else if (direction === 'day' || direction === 'month') {
				directionLeftMove = "+=0";
				eventContentHeight = 0;
			}
		}

		flags.wrap.find('.eventsCalendar-list').animate({
			opacity: eventsOpts.moveOpacity,
			left: directionLeftMove,
			height: eventContentHeight
		}, eventsOpts.moveSpeed, function() {
			flags.wrap.find('.eventsCalendar-list').css({'left':0, 'height': 'auto'}).hide();
			//wrap.find('.eventsCalendar-list li').fadeIn();

			var events = [];

			data = $(data).sort(sortJson); // sort event by dates

			// each event
			if (data.length) {

				// show or hide event description
				var eventDescClass = '';
				if(!eventsOpts.showDescription) {
					eventDescClass = '';
				}
				var eventLinkTarget = "_self";
				if(eventsOpts.openEventInNewWindow) {
					eventLinkTarget = '_target';
				}

				var i = 0;
				$.each(data, function(key, event) {
					if (eventsOpts.jsonDateFormat == 'human') {
						var eventDateTime = event.date.split(" "),
							eventDate = eventDateTime[0].split("-"),
							eventTime = eventDateTime[1].split(":"),
							eventYear = eventDate[0],
							eventMonth = parseInt(eventDate[1]) - 1,
							eventDay = parseInt(eventDate[2]),
							//eventMonthToShow = eventMonth,
							eventMonthToShow = parseInt(eventMonth) + 1,
							eventHour = eventTime[0],
							eventMinute = eventTime[1],
							eventSeconds = eventTime[2],
							eventDate = new Date(eventYear, eventMonth, eventDay, eventHour, eventMinute, eventSeconds);
					} else {
						var eventDate = new Date(parseInt(event.date)),
							eventYear = eventDate.getFullYear(),
							eventMonth = eventDate.getMonth(),
							eventDay = eventDate.getDate(),
							eventMonthToShow = eventMonth + 1,
							eventHour = eventDate.getHours(),
							eventMinute = eventDate.getMinutes();

					}

					if (parseInt(eventMinute) <= 9) {
						eventMinute = "0" + parseInt(eventMinute);
					}


					if (limit === 0 || limit > i) {
						// if month or day exist then only show matched events

						if ((month === false || month == eventMonth)
								&& (day == '' || day == eventDay)
								&& (year == '' || year == eventYear) // get only events of current year
							) {
								// if initial load then load only future events
								if (month === false && eventDate < new Date()) {

								} else {
									eventStringDate = eventDay + "/" + eventMonthToShow + "/" + eventYear;
									if (event.url) {
										var eventTitle = '<a href="'+event.url+'" target="' + eventLinkTarget + '" class="eventTitle">' + event.title + '</a>';
									} else {
										
										var eventTitle ="";
										if(event.nombre_primera_vez==null){
											 eventTitle ='<span class="eventTitle">'+event.title+'</span>';
										}else{											
											eventTitle ='<span class="eventTitle">'+event.title+' ('+event.nombre_primera_vez+')</span>';
										}
									}
									var operaciones='';
									if(eventsOpts.txt_operacion=="eliminar"){
										operaciones='<img src="images/eliminar.png" class="manita" onclick="eliminarCita('+event.clave_cita+')" title="Cancelar Cita">';
									}
									if(eventsOpts.txt_operacion=="asistir"){
										operaciones='<img src="images/asistir.png" class="manita" onclick="asistirCita('+event.clave_cita+')" title="Asistir Cita">';
									}	
									//hsuarez
									//var nombre="";
									if(eventsOpts.txt_operacion=="registrar"){
										//alert(event.title);
										if(event.title=="PRIMERA VEZ VALORACION" || event.title=="TAMIZ DE NEURODESARROLLO NUEVO PAQUETE"){
											//alert(event.nombre_primera_vez);
											if(event.nombre_primera_vez==null){
												operaciones='<img src="images/editar_nombre.png" class="manita" onclick="asignarNombre('+event.clave_cita+')" title="Asistir Cita">';
											}
										}
									}
									events.push('<li id="' + key + '" class="'+event.type+'"><div class="citas"><time datetime="'+eventDate+'"><em>' + eventStringDate + '</em><small>'+eventHour+":"+eventMinute+'</small></time>'+eventTitle+'<p class="eventDesc ' + eventDescClass + '"> ' + event.description + '</p></div><div class="operacionCita">'+operaciones+'</div><div id="operacionCitaContenido'+event.clave_cita+'"></div></li>');
									i++;
								}
						}
					}

					// add mark in the dayList to the days with events
					
					if (eventYear == flags.wrap.attr('data-current-year') && eventMonth == flags.wrap.attr('data-current-month')) {
						
							if(event.total==$("#cantidadhorarios").val()){
								flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(eventDay)).addClass('dayWithoutEvents');
							}else{
								flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(eventDay)).addClass('dayWithEvents');
							}
						
						
					}
					//alert(i);
					
					
					//alert(events.length);

				});
			}
			// there is no events on this period
			
			if (!events.length) {
				events.push('<li class="eventsCalendar-noEvents"><p>' + eventsOpts.txt_noEvents + '</p></li>');
			}
			flags.wrap.find('.eventsCalendar-loading').hide();

			flags.wrap.find('.eventsCalendar-list')
				.html(events.join(''));

			flags.wrap.find('.eventsCalendar-list').animate({
				opacity: 1,
				height: "toggle"
			}, eventsOpts.moveSpeed);


		});
		setCalendarWidth();
	}

	function changeMonth() {
		flags.wrap.find('.arrow').click(function(e){
			e.preventDefault();

			if ($(this).hasClass('next')) {
				dateSlider("next");
				var lastMonthMove = '-=' + flags.directionLeftMove;

			} else {
				dateSlider("prev");
				var lastMonthMove = '+=' + flags.directionLeftMove;
			}

			flags.wrap.find('.eventsCalendar-monthWrap.oldMonth').animate({
				opacity: eventsOpts.moveOpacity,
				left: lastMonthMove
			}, eventsOpts.moveSpeed, function() {
				flags.wrap.find('.eventsCalendar-monthWrap.oldMonth').remove();
			});
		});
	}

	function showError(msg) {
		flags.wrap.find('.eventsCalendar-list-wrap').html("<span class='eventsCalendar-loading error'>"+msg+" " +eventsOpts.eventsjson+"</span>");
	}

	function setCalendarWidth(){
		// resize calendar width on window resize
		flags.directionLeftMove = flags.wrap.width();
		flags.wrap.find('.eventsCalendar-monthWrap').width(flags.wrap.width() + 'px');

		flags.wrap.find('.eventsCalendar-list-wrap').width(flags.wrap.width() + 'px');

	}
};


// define the parameters with the default values of the function
$.fn.eventCalendar.defaults = {
    eventsjson: 'js/events.json',
	eventsLimit: 100,
	monthNames: [ "January", "February", "March", "April", "May", "June",
		"July", "August", "September", "October", "November", "December" ],
	dayNames: [ 'Sunday','Monday','Tuesday','Wednesday',
		'Thursday','Friday','Saturday' ],
	dayNamesShort: [ 'Sun','Mon','Tue','Wed', 'Thu','Fri','Sat' ],
	txt_noEvents: "There are no events in this period",
	txt_SpecificEvents_prev: "",
	txt_SpecificEvents_after: "events:",
	txt_next: "next",
	txt_prev: "prev",
	txt_NextEvents: "Next events:",
	txt_GoToEventUrl: "See the event",
	txt_operacion:"registrar",
	showDayAsWeeks: true,
	startWeekOnMonday: true,
	showDayNameInCalendar: true,
	showDescription: false,
	onlyOneDescription: true,
	openEventInNewWindow: false,
	eventsScrollable: false,
	jsonDateFormat: 'timestamp', // you can use also "human" 'YYYY-MM-DD HH:MM:SS'
	moveSpeed: 500,	// speed of month move when you clic on a new date
	moveOpacity: 0.15, // month and events fadeOut to this opacity
	jsonData: "", 	// to load and inline json (not ajax calls)
	cacheJson: true	// if true plugin get a json only first time and after plugin filter events
					// if false plugin get a new json on each date change
};

