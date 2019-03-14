<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BotUIサンプル</title>
    <link rel="stylesheet" href="https://unpkg.com/botui/build/botui.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/botui/build/botui-theme-default.css" />
  </head>
  <body>

    <div class="botui-app-container" id="bot">
      <bot-ui></bot-ui>
    </div>

    <script src="https://cdn.jsdelivr.net/vue/latest/vue.min.js"></script>
    <script src="https://unpkg.com/botui/build/botui.min.js"></script>
   <!-- <script src="main.js"></script> -->
  </body>
</html>

<script>

var data = @json($lists);
console.log(data);

var genreData = data.filter(function(item, index) {
    if (item.genre == "PHP") return true;
});
console.log(genreData);

var wordData = genreData.filter(function(item, index){ 
    if (item.word == "Laravel") return true;
});
console.log(wordData);

const botui = new BotUI('bot');

botui.message.bot({
  delay: 500,
  content: 'こんにちは！ Orugaだよ！',
  loading: true
}).
then(() => {
  return botui.message.bot({
    delay: 500,
    loading: true,
    content: 'ジャンルを選んで、わからない単語を入力してね！' });

}).then(() => {
  return botui.action.button({
    delay: 300,
    action: [
    {
      text: 'PHP',
      value: 'PHP' },

    {
      text: 'Ruby',
      value: 'Ruby' },

    {
      text: 'Python',
      value: 'Python' }] });



}).then(res => {
  return botui.message.bot({
    delay: 400,
    loading: true,
    content: 'ジャンルは ' + res.text + 'だね!' });

}).then(() => {
  botui.message.
  bot({
    delay: 700,
    loading: true,
    content: 'わからない単語を教えて ?' }).

  then(function () {
    return botui.action.text({
      delay: 400,
      action: {
        size: 18,
        icon: 'user-circle-o',
        sub_type: 'text',
        placeholder: '? ? ?' } });


  }).then(res => {
    name = res.value; // ユーザーの入力値
    return botui.message.
    bot({

            delay: 300,
            loading: true,
            content: name + 'はわからないな ! !' 
      });

  }).then(function() {
    return botui.message.bot({
      delay: 300,
      content: '続けて検索しますか？'
    })
  }).then(function() {
      //「はい」「いいえ」のボタンを表示
      return botui.action.button({
        delay: 300,
        action: [{
          icon: 'circle-thin',
          text: 'はい',
          value: true
        }, {
          icon: 'close',
          text: 'いいえ',
          value: false
        }]
      });
  }).then(function(res) {
    res.value ? init() : end();
  });

  function end() {
    botui.message.bot({
      content: 'ご利用ありがとうございました！'
    })
  }

});
</script>