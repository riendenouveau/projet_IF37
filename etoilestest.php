<style>

.rating {
  padding: 5px 10px;
  width : 200px;
  border-radius: 30px;
  background: #FFF;
  display: block;
  overflow: hidden;
  margin : 10px 0px;
  font-size : 2em;
  

  
  box-shadow: 0 1px #CCC,
              0 5px #DDD,
              0 9px 6px -3px #999;
  
}
.rating:not(:checked) > input {
  display: none;
}

.rating label {
    width : 20%;
    text-align : center;
}

#rate:not(:checked) > label {
  cursor:pointer;
  float: right;
  display: block;
  
  color: rgba(0, 135, 211, .4);
}
#rate:not(:checked) > label:hover,
#rate:not(:checked) > label:hover ~ label {
  color: rgba(0, 135, 211, .6);
}
#rate > input:checked + label:hover,
#rate > input:checked + label:hover ~ label,
#rate > input:checked ~ label:hover,
#rate > input:checked ~ label:hover ~ label,
#rate > label:hover ~ input:checked ~ label {
  color: rgba(0, 135, 211, .8);
}
#rate > input:checked ~ label {
  color: rgb(0, 135, 211);
}
</style>





<section id="rate" class="rating">
  <!-- FIFTH STAR -->
  <input type="radio" id="star_5" name="q1" value="5" />
  <label for="star_5" title="Five">&#9733;</label>
  <!-- FOURTH STAR -->
  <input type="radio" id="star_4" name="q1" value="4" />
  <label for="star_4" title="Four">&#9733;</label>
  <!-- THIRD STAR -->
  <input type="radio" id="star_3" name="q1" value="3" />
  <label for="star_3" title="Three">&#9733;</label>
  <!-- SECOND STAR -->
  <input type="radio" id="star_2" name="q1" value="2" />
  <label for="star_2" title="Two">&#9733;</label>
  <!-- FIRST STAR -->
  <input type="radio" id="star_1" name="q1" value="1" />
  <label for="star_1" title="One">&#9733;</label>
</section>


<section id="rate" class="rating">
  <!-- FIFTH STAR -->
  <input type="radio" id="s5" name="q2" value="5" />
  <label for="s5" title="Five">&#9733;</label>
  <!-- FOURTH STAR -->
  <input type="radio" id="s4" name="q2" value="4" />
  <label for="s4" title="Four">&#9733;</label>
  <!-- THIRD STAR -->
  <input type="radio" id="s3" name="q2" value="3" />
  <label for="s3" title="Three">&#9733;</label>
  <!-- SECOND STAR -->
  <input type="radio" id="s2" name="q2" value="2" />
  <label for="s2" title="Two">&#9733;</label>
  <!-- FIRST STAR -->
  <input type="radio" id="s1" name="q2" value="1" />
  <label for="s1" title="One">&#9733;</label>
</section>


<section id="rate" class="rating">
  <!-- FIFTH STAR -->
  <input type="radio" id="e5" name="q3" value="5" />
  <label for="e5" title="Five">&#9733;</label>
  <!-- FOURTH STAR -->
  <input type="radio" id="e4" name="q3" value="4" />
  <label for="e4" title="Four">&#9733;</label>
  <!-- THIRD STAR -->
  <input type="radio" id="e3" name="q3" value="3" />
  <label for="e3" title="Three">&#9733;</label>
  <!-- SECOND STAR -->
  <input type="radio" id="e2" name="q3" value="2" />
  <label for="e2" title="Two">&#9733;</label>
  <!-- FIRST STAR -->
  <input type="radio" id="e1" name="q3" value="1" />
  <label for="e1" title="One">&#9733;</label>
</section>