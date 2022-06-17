var words1 = ['Web', 'Mobile '],
    part1,
    j = 0,
    offset1 = 0,
    len1 = words1.length,
    forwards1 = true,
    skip_count1 = 0,
    skip_delay1 = 20,
    speed1 = 100;
var wordflick1 = function () {
  setInterval(function () {
    if (forwards1) {
      if (offset1 >= words1[j].length) {
        ++skip_count1;
        if (skip_count1 == skip_delay1) {
          forwards1 = false;
          skip_count1 = 0;
        }
      }
    }
    else {
      if (offset1 == 0) {
        forwards1 = true;
        j++;
        offset1 = 0;
        if (j >= len1) {
            j = 0;
        }
      }
    }
    part1 = words1[j].substr(0, offset1);
    if (skip_count1 == 0) {
      if (forwards1) {
        offset1++;
      }
      else {
        offset1--;
      }
    }
    $('.word1').text(part1);
  },speed1);
};

$(document).ready(function () {
  wordflick1();
});