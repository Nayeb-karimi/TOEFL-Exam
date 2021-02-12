<template>
<section>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-3 mb-3">
        <div class="text-center text-white">
            <span style="font-size: 50px">{{ minutes }}</span><span style="font-size: 50px">:</span><span style="font-size: 50px">{{ seconds }}</span>
        </div>
        <div class="text-center"> 
          <button class="btn btn-light text-primary" @click="startTimer"><i class="fa fa-play-circle"></i></button>
          <button class="btn btn-light text-primary" v-if="timer" @click="stopTimer"><i class="fa fa-pause-circle"></i></button>
          <button class="btn btn-light text-primary" v-if="resetButton" @click="resetTimer"><i class="fa fa-undo"></i></button>
        </div>
      </div>
    </div>
  </div>
</section>
</template>
<script>
var audio = new Audio('../../../audio/notification.mp3');
export default {
    data() {
        return{
            timer: null,
            totalTime: (1 * 60),
            resetButton: false,
        }
    },
    mounted(){},
	methods: {
		startTimer: function() {
			this.timer = setInterval(() => this.countdown(), 1000);
			this.resetButton = true;
		},
		stopTimer: function() {
			clearInterval(this.timer);
			this.timer = nullthis.resetButton = true;
		},
		resetTimer: function() {
			this.totalTime = (1 * 60);
			clearInterval(this.timer);
			this.timer = null;
			this.resetButton = false;
		},
		padTime: function(time) {
			return (time < 10 ? '0' : '') + time;
		},
		countdown: function() {
			if(this.totalTime >= 1) {
				this.totalTime--;
			} else {
                audio.play();
				this.totalTime = 0;
				this.resetTimer;
			}
		}
	},
	// =======================
	computed: {
		minutes: function() {
			const minutes = Math.floor(this.totalTime / 60);
			return this.padTime(minutes);
		},
		seconds: function() {
			const seconds = this.totalTime - (this.minutes * 60);
			return this.padTime(seconds);
		}
	}
}
</script>
<style scoped>

</style>