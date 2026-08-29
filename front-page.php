<?php
/**
 * front-page.php — WordPressが自動でトップページとして読み込む特別なファイル名です。
 *
 * 使い方（テンプレート選択・固定ページ作成は不要）:
 * 1) このファイルを、有効なテーマのフォルダに front-page.php という名前でアップロード
 *    例: /wp-content/themes/devgloomyjp/front-page.php
 * 2) サイトのトップ（ドメイン）を開くと、これが表示されます
 *
 * ※「設定 → 表示設定 → ホームページの表示」が「最新の投稿」でも「固定ページ」でも、
 *    front-page.php があればトップページはこの内容が優先されます。
 * ※ テーマのヘッダー/フッターは読み込まず、完全独立のフルスクリーンLPとして表示します。
 * ※ ヒーロー画像 hero-1920.webp / hero-1280.webp / hero-768.webp / hero-1920.jpg は
 *    このファイルと同じ場所（テーマフォルダ直下）に置いてください。
 * ※ 波の動画は wave.mp4 をテーマフォルダ直下（画像と同じ場所）に置けば自動再生され、
 *    画像の上に重なります。
 *    動画が無い／読めない場合はヒーロー画像がそのまま表示されます。
 */
?>
<style>
.hero{
  background-size: 180% auto;      /* 拡大＝表示部分が小さくなる */
  background-position: 0% 50%;
  animation: mg-pan 40s ease-in-out infinite alternate;
}
@keyframes mg-pan{
  from{ background-position: 0% 50%; }
  to  { background-position: 100% 50%; }
}
/* 動きが苦手な人向け */
@media (prefers-reduced-motion: reduce){
  .hero{ animation: none; }
}
</style>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>馬のいななき | UMANO INANAKI</title>
<meta name="description" content="馬のいななき">
<style>
:root{
  --paper:#f2f1ee; --panel:#e9e8e4;
  --ink:#101010; --ink2:#3a3a38; --muted:#8b8a85; --line:#d6d5d0;
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{
  background:var(--paper); color:var(--ink);
  font-family:"Helvetica Neue","Hiragino Kaku Gothic ProN","Yu Gothic",sans-serif;
  overflow-x:hidden; line-height:1.7; -webkit-font-smoothing:antialiased;
}
a{color:inherit;text-decoration:none}

.progress{position:fixed;top:0;left:0;height:2px;width:0;z-index:200;background:var(--ink)}
nav{position:fixed;top:0;left:0;right:0;z-index:150;display:flex;justify-content:space-between;align-items:center;
  padding:24px 6vw;opacity:0;transition:opacity .8s;mix-blend-mode:difference;color:#fff}
nav.show{opacity:1}
nav .logo{font-weight:700;letter-spacing:5px;font-size:15px}
nav ul{display:flex;gap:30px;list-style:none;font-size:12px;letter-spacing:3px}
nav a{position:relative}
nav a::after{content:"";position:absolute;left:0;bottom:-5px;width:0;height:1px;background:#fff;transition:width .3s}
nav a:hover::after{width:100%}
@media(max-width:760px){nav ul{display:none}}

section{position:relative;z-index:3;padding:15vh 8vw}

.hero{height:100vh;min-height:600px;position:relative;overflow:hidden;background:#060606}

/* --- ヒーロー画像（下地。動画が無い場合はこれがそのまま見える） --- */
.hero .poster{position:absolute;inset:0;z-index:0;display:block}
.hero .poster img{
  width:100%;height:100%;object-fit:cover;
  filter:brightness(.88) saturate(.95);
  animation:slowzoom 20s ease-in-out infinite alternate;
  /* モノクロにするなら上のfilterを次の行に差し替え:
     filter:grayscale(1) contrast(1.08) brightness(.85); */
}
@keyframes slowzoom{0%{transform:scale(1.02)}100%{transform:scale(1.12)}}

/* --- 動画（読み込めたときだけ画像の上にフェードイン） --- */
.hero video{
  position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
  width:100%;height:100%;object-fit:cover;
  z-index:2;opacity:0;transition:opacity 1.2s ease;
}
.hero.hasvideo video{
  opacity:1;
  animation:crashIn 2.6s cubic-bezier(.16,.8,.24,1) both, drift 14s ease-in-out 2.6s infinite;
}
@keyframes crashIn{0%{transform:translate(-50%,-50%) scale(1.55)}100%{transform:translate(-50%,-50%) scale(1.06)}}
@keyframes drift{0%,100%{transform:translate(-50%,-50%) scale(1.06)}50%{transform:translate(-50%,-52%) scale(1.12)}}

.hero .overlay{position:absolute;inset:0;z-index:4;pointer-events:none;
  background:linear-gradient(90deg,rgba(0,0,0,.5) 0%,transparent 55%),linear-gradient(0deg,rgba(0,0,0,.55),transparent 45%)}
.hero .copy{position:absolute;z-index:6;left:8vw;bottom:16vh;color:#fff;
  opacity:0;transform:translateY(24px);transition:opacity 1.1s .1s,transform 1.1s .1s}
.hero.reveal .copy{opacity:1;transform:none}
.hero .kick{font-size:12px;letter-spacing:10px;font-weight:600;margin-bottom:20px;padding-left:3px}
.hero h1{font-weight:200;font-size:clamp(46px,10vw,140px);letter-spacing:.12em;line-height:.98;text-shadow:0 4px 40px rgba(0,0,0,.5)}
.hero h1 b{font-weight:700}
.hero .jp{font-size:clamp(15px,2vw,20px);letter-spacing:14px;color:#eaeaea;margin-top:18px;font-weight:300;padding-left:5px}
.hero .tag{margin-top:28px;max-width:440px;font-size:14px;letter-spacing:1.5px;color:#dcdcdc;line-height:2;font-weight:300}
.hero .cta{margin-top:34px;display:flex;gap:14px;flex-wrap:wrap}
.btn{display:inline-flex;align-items:center;gap:10px;padding:15px 34px;font-weight:600;font-size:12px;letter-spacing:3px;transition:all .3s;pointer-events:auto}
.btn.solid{background:#fff;color:#0a0a0a}
.btn.solid:hover{background:transparent;color:#fff;box-shadow:inset 0 0 0 1px #fff}
.btn.ghost{box-shadow:inset 0 0 0 1px rgba(255,255,255,.6)}
.btn.ghost:hover{background:#fff;color:#0a0a0a}
.scroll-ind{position:absolute;bottom:30px;left:50%;transform:translateX(-50%);z-index:6;font-size:10px;letter-spacing:4px;color:#fff;display:flex;flex-direction:column;align-items:center;gap:8px;opacity:0;transition:opacity 1s 1.6s}
.hero.reveal .scroll-ind{opacity:.85}
.scroll-ind i{width:1px;height:46px;background:linear-gradient(#fff,transparent);animation:drop 1.9s ease-in-out infinite}
@keyframes drop{0%{transform:scaleY(0);transform-origin:top}50%{transform:scaleY(1);transform-origin:top}50.1%{transform-origin:bottom}100%{transform:scaleY(0);transform-origin:bottom}}

@media(prefers-reduced-motion:reduce){
  .hero .poster img{animation:none}
  .hero.hasvideo video{animation:none}
}

.marquee{z-index:3;position:relative;padding:20px 0;border-top:1px solid var(--line);border-bottom:1px solid var(--line);white-space:nowrap;overflow:hidden}
.marquee .track{display:inline-flex;gap:40px;animation:scroll 24s linear infinite;font-weight:200;font-size:clamp(20px,4vw,42px);letter-spacing:6px;align-items:center;color:var(--ink)}
.marquee .track b{-webkit-text-stroke:1px var(--ink);color:transparent;font-weight:700}
@keyframes scroll{to{transform:translateX(-50%)}}

.rv{opacity:0;transform:translateY(36px);transition:opacity 1s cubic-bezier(.2,.8,.2,1),transform 1s cubic-bezier(.2,.8,.2,1)}
.rv.in{opacity:1;transform:none}
.stitle{font-size:11px;letter-spacing:6px;color:var(--muted);margin-bottom:20px;font-weight:600}
.h2{font-size:clamp(28px,5.5vw,60px);font-weight:200;line-height:1.15;letter-spacing:.06em;margin-bottom:28px}
.h2 b{font-weight:700}

.about{max-width:1100px;margin:0 auto}
.about .lead{font-size:clamp(17px,2.2vw,24px);max-width:760px;font-weight:400;letter-spacing:.02em;line-height:1.9}
.about p{color:var(--ink2);max-width:660px;margin-top:22px;font-size:15px;letter-spacing:.02em}

.loves{max-width:1100px;margin:0 auto}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1px;background:var(--line);border:1px solid var(--line);margin-top:24px}
.card{position:relative;padding:36px 26px;background:var(--paper);transition:background .35s;text-align:left}
.card:hover{background:var(--panel)}
.card .no{font-size:11px;letter-spacing:3px;color:var(--muted);font-weight:600}
.card .emo{font-size:34px;line-height:1;margin:16px 0 12px;filter:grayscale(1);transition:transform .35s,filter .35s}
.card:hover .emo{transform:scale(1.15);filter:grayscale(0)}
.card h3{font-size:17px;font-weight:700;letter-spacing:.04em;margin-bottom:6px}
.card p{color:var(--ink2);font-size:13px;letter-spacing:.02em}

.numsec{max-width:1100px;margin:0 auto}
.nums{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:30px;margin-top:20px}
.num{border-top:1px solid var(--ink);padding-top:18px}
.num h4{font-size:clamp(40px,8vw,84px);font-weight:200;line-height:1;letter-spacing:-.02em}
.num h4 em{font-style:normal;font-weight:700}
.num span{color:var(--muted);font-size:12px;letter-spacing:3px;font-weight:600;display:block;margin-top:8px}

.contact{text-align:center;padding:18vh 8vw;background:#0a0a0a;color:#fff;position:relative;z-index:3}
.contact .stitle{color:#9a9a9a}
.contact .big{font-size:clamp(44px,11vw,140px);font-weight:200;letter-spacing:.04em;line-height:1}
.contact .big a{font-weight:700;position:relative}
.contact .big a::after{content:"";position:absolute;left:0;bottom:8px;width:100%;height:2px;background:#fff;transform:scaleX(0);transform-origin:left;transition:transform .4s}
.contact .big a:hover::after{transform:scaleX(1)}
.socials{display:flex;gap:28px;justify-content:center;margin-top:44px;flex-wrap:wrap;font-size:12px;letter-spacing:3px;color:#9a9a9a;font-weight:600}
.socials a:hover{color:#fff}
footer{text-align:center;padding:40px 6vw;color:var(--muted);font-size:11px;letter-spacing:3px;position:relative;z-index:3}
</style>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="progress" id="prog"></div>

<nav id="nav">
  <div class="logo">U . I</div>
  <ul>
    <li><a href="#about">ABOUT</a></li>
    <li><a href="#loves">LOVES</a></li>
    <li><a href="#numbers">STATS</a></li>
    <li><a href="#contact">CONTACT</a></li>
  </ul>
</nav>

<header class="hero" id="hero">

  <!-- ヒーロー画像。画面幅で3サイズを出し分け、WebP非対応ブラウザにはJPGを返す -->
  <picture class="poster">
    <source media="(max-width:767px)"  srcset="<?php echo esc_url( get_theme_file_uri( 'hero-768.webp' ) ); ?>"  type="image/webp">
    <source media="(max-width:1279px)" srcset="<?php echo esc_url( get_theme_file_uri( 'hero-1280.webp' ) ); ?>" type="image/webp">
    <source                            srcset="<?php echo esc_url( get_theme_file_uri( 'hero-1920.webp' ) ); ?>" type="image/webp">
    <img src="<?php echo esc_url( get_theme_file_uri( 'hero-1920.jpg' ) ); ?>"
         alt="" width="1920" height="1080" fetchpriority="high" decoding="async">
  </picture>

  <!-- 波の動画。wave.mp4 をテーマフォルダ直下に置くと、読み込めた時だけ画像の上に重なる -->
  <video id="wave" autoplay muted loop playsinline preload="auto"
         poster="<?php echo esc_url( get_theme_file_uri( 'hero-1920.jpg' ) ); ?>">
    <source src="<?php echo esc_url( get_theme_file_uri( 'wave.mp4' ) ); ?>" type="video/mp4">
  </video>

  <div class="overlay"></div>
  <div class="copy">
    <div class="kick">OFFICIAL SITE</div>
    <h1>UMANO<br><b>INANAKI</b></h1>
    <div class="jp">馬 の　い な な き</div>
    <p class="tag">波に乗り、山を登り、馬を駆り、うまいものを探す。<br>全部に全力で乗っかる人生。</p>
    <div class="cta">
      <a href="#contact" class="btn solid">CONTACT</a>
      <a href="#loves" class="btn ghost">My life</a>
    </div>
  </div>
  <div class="scroll-ind">SCROLL<i></i></div>
</header>

<div class="marquee">
  <div class="track">
    <span>SURF</span><b>MOTO</b><span>乗馬</span><b>ROAD</b><span>登山</span><b>FOOD</b><span>SURF</span><b>MOTO</b><span>乗馬</span><b>ROAD</b><span>登山</span><b>FOOD</b>
  </div>
</div>

<section id="about">
  <div class="about">
    <div class="stitle rv">01 &nbsp;—&nbsp; ABOUT</div>
    <div class="h2 rv">止まらない、<br><b>フルスロットル</b>な毎日。</div>
    <p class="lead rv">波を追い、山に登り、馬を駆り、風を切って走る。大切な人と動物に囲まれ、うまいものを探し、仕事にも全力。馬のいななき の毎日は、いつだって全開です。</p>
    <p class="rv"></p>
  </div>
</section>

<section id="loves">
  <div class="loves">
    <div class="stitle rv">02 &nbsp;—&nbsp; MY LOVES</div>
    <div class="h2 rv">全力で<b>好きなもの</b></div>
    <div class="grid">
      <div class="card rv"><div class="no">01</div><div class="emo">💍</div><h3>奥さん</h3><p>何より大切で最高のパートナー。</p></div>
      <div class="card rv"><div class="no">02</div><div class="emo">🐈‍⬛</div><h3>黒猫</h3><p>気まぐれで、最高の癒し。</p></div>
      <div class="card rv"><div class="no">03</div><div class="emo">🐩</div><h3>トイプードル</h3><p>いつも全力でお出迎え。</p></div>
      <div class="card rv"><div class="no">04</div><div class="emo">🏍</div><h3>オートバイ</h3><p>五感で味わえる最高の鉄馬</p></div>
      <div class="card rv"><div class="no">05</div><div class="emo">🚴</div><h3>ロードバイク</h3><p>自分の脚で走る自由。</p></div>
      <div class="card rv"><div class="no">06</div><div class="emo">🐎</div><h3>乗馬</h3><p>馬上から見る景色は格別。</p></div>
      <div class="card rv"><div class="no">07</div><div class="emo">🏄</div><h3>サーフィン</h3><p>御宿　波の上が一番の居場所。</p></div>
      <div class="card rv"><div class="no">08</div><div class="emo">🍜</div><h3>食べ歩き</h3><p>うまいもの探しは人生の醍醐味。</p></div>
      <div class="card rv"><div class="no">09</div><div class="emo">⛰️</div><h3>登山</h3><p>挑戦する気持ちを思い出させてくれる。</p></div>
      <div class="card rv"><div class="no">10</div><div class="emo">💼</div><h3>仕事</h3><p>遊ぶように、本気で働く。</p></div>
    </div>
  </div>
</section>

<section id="numbers">
  <div class="numsec">
    <div class="stitle rv">03 &nbsp;—&nbsp; IN NUMBERS</div>
    <div class="h2 rv">数字で見る</div>
    <div class="nums">
      <div class="num rv"><h4><em data-count="10">0</em></h4><span>好きなもの</span></div>
      <div class="num rv"><h4><em data-count="365">0</em>日</h4><span>アクティブ</span></div>
      <div class="num rv"><h4><em data-count="2">0</em></h4><span>相棒（黒猫＋プードル）</span></div>
      <div class="num rv"><h4><em data-count="100">0</em>%</h4><span>フルスロットル</span></div>
    </div>
  </div>
</section>

<section id="contact" class="contact">
  <div class="stitle rv">04 &nbsp;—&nbsp; CONTACT</div>
  <div class="big rv">Let's <a href="mailto:hello@example.com">ride.</a></div>
  <div class="socials rv">
    <a href="mailto:hello@example.com">EMAIL</a>
    <a href="#">X / TWITTER</a>
    <a href="#">INSTAGRAM</a>
    <a href="#">NOTE</a>
  </div>
</section>

<footer>© <span id="yr"></span> 馬のいななき / UMANO INANAKI — RIDE YOUR WAVE</footer>

<script>
document.getElementById('yr').textContent=new Date().getFullYear();

var hero=document.getElementById('hero'),vid=document.getElementById('wave');

// 動画が実際に再生できたときだけ hasvideo を付ける。付かなければ画像のまま。
vid.addEventListener('loadeddata',function(){ if(vid.videoWidth>0) hero.classList.add('hasvideo'); });
vid.addEventListener('error',function(){ hero.classList.remove('hasvideo'); });
if(vid.querySelector('source')){
  vid.querySelector('source').addEventListener('error',function(){ hero.classList.remove('hasvideo'); });
}

window.addEventListener('load',function(){
  setTimeout(function(){hero.classList.add('reveal');document.getElementById('nav').classList.add('show');},1200);
  var p=vid.play(); if(p&&p.catch)p.catch(function(){});
});

addEventListener('scroll',function(){var h=document.documentElement;
  document.getElementById('prog').style.width=(h.scrollTop/(h.scrollHeight-h.clientHeight)*100)+'%';});

var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target);}});},{threshold:.15});
document.querySelectorAll('.rv').forEach(function(el,i){el.style.transitionDelay=(i%4*.07)+'s';io.observe(el);});

var cio=new IntersectionObserver(function(es){es.forEach(function(e){
  if(!e.isIntersecting)return;var el=e.target,end=+el.dataset.count;
  var t0=null,dur=1500;
  var step=function(t){if(!t0)t0=t;var p=Math.min((t-t0)/dur,1);el.textContent=Math.floor((1-Math.pow(1-p,3))*end);if(p<1)requestAnimationFrame(step);};
  requestAnimationFrame(step);cio.unobserve(el);
});},{threshold:.6});
document.querySelectorAll('[data-count]').forEach(function(el){cio.observe(el);});
</script>

<?php wp_footer(); ?>
</body>
</html>
