import dane from './dane.js';



let app = new Vue({
  el: '#app',
  data: {
    error:'',
    run:false,
    piosenka:'',
    mytext: '',
    dane:dane,
    fragmenty: {},
    fragmentindex: 0,
    napisy: false

  },
  methods: {
    setSong(){
        this.error = '';
        this.fragmentindex = -1;
        console.log('SET SONG');
        document.getElementById("audioelem").setAttribute('src', 'muzyka/'+this.piosenka+'.mp3');
        this.fragmenty  = this.dane[this.piosenka];

    },
    play() {
   

        this.run = true;
      document.getElementById('napisy').innerHTML = '';


      let self = this;
      let audi = document.getElementById('audioelem');

      audi.currentTime = self.fragmenty[self.fragmentindex].start;
      audi.play();

      setTimeout(function () {
        audi.pause();
        self.run = false;
      }, self.fragmenty[self.fragmentindex].duration * 1000);



    },
    next(){
        if(this.fragmentindex >= this.fragmenty.length - 1){
            this.error = 'KONIEC';
            return;
        }

        this.fragmentindex = this.fragmentindex + 1;
        this.play();
    },

    podejrzyjnapisym(){
      document.getElementById('napisy').innerHTML = this.fragmenty[this.fragmentindex].tekst;
    }
  }

})
