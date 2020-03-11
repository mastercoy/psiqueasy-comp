<template>
<div class="form-temp">
   <div class="container">
    <div class="form-group">
    <label for="exampleFormControlSelect1">Example select</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  
     <button class="btn btn-primary btn-block" @click="handleAddConsulta"> Agendar Atendimento</button>
    <div class="row">      
      <div class="col-md-12">
        <full-calendar :events="events" :config="config" :eventTimeFormat='eventTimeFormat'/>
      </div>
      <!-- <div class="col-md-3"></div> -->
      <div class="row"><br>
        <div class="col-md-2">          
        </div>
        <div class="col-md-8">         
        </div>
        <div class="col-md-2">

        </div>
      </div>
    </div>
  </div>

</div>
 
</template>

<script>

import { FullCalendar } from 'vue-full-calendar';

export default {
  data() {
    return {
      header: [
        {
          left:   'title',
          center: '',
          right:  'Hoje , prev,next',
          Hoje: 'today',
          month: 'Mes'
        }
      ],
      events: [
         {   
            id        : 'a',
            textColor : 'white',
            title     : 'Dra Cláudia - Clarisse',
            start     : '2020-03-03T12:30:00',
            end       :  '2020-03-03T13:20:00',
            editable  : true
         },
         {   
            id     : 'c',
            textColor : 'white',
            title  : 'Dra Livia - Roberto',
            start  : '2020-03-03T15:30:00',
            end    : '2020-03-03T16:20:00',
            extendedProps: {
              status: 'done'
            }
        },
        {   
            id     : 'b',
            textColor : 'white',
            color  : 'green',
            title  : 'Dra. Joaquina - Anna',
            end    : '2020-03-03T14:00:00',
            start  :  '2020-03-03T13:20:00'
        },
         {   
            id     : 'd',
            textColor : 'white',
            color  : 'orange',
            title  : 'Atendimento - Clarisse',
            end    : '2020-03-03T14:00:00',
            start  : '2020-03-03T13:20:00'
        },
        {
            title  : 'event2',
            start  : '2010-01-05',
            end    : '2010-01-07',
        },
        {
            title  : 'event3',
            start  : '2020-04-04T12:30:00',
            allDay : false,
        },
        {
          title    : 'My Event',
          start    : '2020-03-01',
        }
        ],         
        eventTimeFormat: { // like '14:30:00'
          hour: '2-digit',
          minute: '2-digit',
          meridiem: 'short'
        },
        config: {          
          locale: 'pt-br',  
          eventLimit: true,
          views: {
            timeGrid: {
              eventLimit: 3 // adjust to 6 only for timeGridWeek/timeGridDay
            } 
          }         
       },
        eventClick: function(info) {
         console.log('testando...'+ info)
        }      
    }
  },
  components: {
    FullCalendar,
  },
  methods: {
     handleAddConsulta() {
       const newAtend = {
          id     : 'e',
          textColor : 'white',
          color  : 'orange',
          title  : 'Atendimento - Livia',
          end    : '2020-03-20T14:00:00',
          start  :  '2020-03-20T13:20:00'
       }
       this.events.push(newAtend);
     }
  }
}
</script>