var words2 = ['Industrial machines', 'The automation of systems '],
    part2,
    k = 0,
    offset2 = 0,
    len2 = words2.length,
    forwards2 = true,
    skip_count2 = 0,
    skip_delay2 = 20,
    speed2 = 100;
var wordflick2 = function () {
  setInterval(function () {
    if (forwards2) {
      if (offset2 >= words2[k].length) {
        ++skip_count2;
        if (skip_count2 == skip_delay2) {
          forwards2 = false;
          skip_count2 = 0;
        }
      }
    }
    else {
      if (offset2 == 0) {
        forwards2 = true;
        k++;
        offset2 = 0;
        if (k >= len2) {
            k = 0;
        }
      }
    }
    part2 = words2[k].substr(0, offset2);
    if (skip_count2 == 0) {
      if (forwards2) {
        offset2++;
      }
      else {
        offset2--;
      }
    }
    $('.word2').text(part2);
  },speed2);
};

$(document).ready(function () {
  wordflick2();
});