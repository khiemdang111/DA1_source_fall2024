<?php

namespace App\Views\Client\Pages\Lucky_spin;

use App\Helpers\AuthHelper;
use App\Views\BaseView;

class Luky_spin extends BaseView
{
    public static function render($data = null)
    {

?>
 <div class="col text-center">
                <h1 class="my-4">Vòng quay may mắn</h1>
            </div>
<div class="bodylucky">
   
  <div class="mainboxlucky" id="mainboxlucky">
    <div class="arrow"></div>
    
    <div class="box" id="box">
      <div class="box1">
        <span class="font span1"><b>Prize 1</b></span>
        <span class="font span2"><b>Prize 2</b></span>
       
      </div>
      <div class="box2">
        <span class="font span3"><b>Prize 3</b></span>
        <span class="font span4"><b>Prize 2</b></span>
        
      </div>
    </div>
    <button class="spin" onclick="spin()">SPIN</button>
  </div>
</div>
   
<script>
function shuffle(array) {
    let currentIndex = array.length, randomIndex;
    while (currentIndex != 0) {
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex--;
        [array[currentIndex], array[randomIndex]] = [array[randomIndex], array[currentIndex]];
    }
    return array;
}

function spin() {
    const box = document.getElementById("box");
    const element = document.getElementById("mainboxlucky");
    let selectedItem = "";

    // Các góc quay tương ứng với các ô
    const prizes = {
        90: "cam",
        180: "xanh biển",
        270: "PXanh lá",
        360: "tím"
    };

    // Random chọn góc trúng thưởng
    const angles = [90, 180, 270, 360]; 
    const randomIndex = Math.floor(Math.random() * angles.length);
    const rotation = angles[randomIndex];

    // Lấy giá trị giải thưởng
    selectedItem = prizes[rotation];

    // Xoay vòng quay
    box.style.transition = "all ease 5s";
    box.style.transform = `rotate(${rotation + 1440}deg)`; // Thêm 1440° để vòng quay xoay nhiều lần

    // Hiển thị kết quả
    setTimeout(() => {
        alert(`Congratulations! You won ${selectedItem}.`);
    }, 5000);

    // Reset vòng quay về trạng thái ban đầu
    setTimeout(() => {
        box.style.transition = "none";
        box.style.transform = "rotate(0deg)";
    }, 6000);
}
</script>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script>
try {
  fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
    return true;
  }).catch(function(e) {
    var carbonScript = document.createElement("script");
    carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
    carbonScript.id = "_carbonads_js";
    document.getElementById("carbon-block").appendChild(carbonScript);
  });
} catch (error) {
  console.log(error);
}
</script>
<?php

    }
}
