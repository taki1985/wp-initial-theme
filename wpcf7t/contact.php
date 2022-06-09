<?php
if (!defined('ABSPATH')) {
  exit;
}
?>

<!--お問い合わせ-->
<div class="flow-contact block-child--md">
  <ul class="list-flow-contact wpcf7c-elm-step1">
    <li class="step step-first current"><span>情報入力</span></li>
    <li class="step"><span>入力内容確認</span></li>
    <li class="step"><span>送信完了</span></li>
  </ul>
  <ul class="list-flow-contact wpcf7c-elm-step2">
    <li class="step step-first"><span>情報入力</span></li>
    <li class="step current"><span>入力内容確認</span></li>
    <li class="step"><span>送信完了</span></li>
  </ul>
  <ul class="list-flow-contact wpcf7c-elm-step3">
    <li class="step step-first"><span>情報入力</span></li>
    <li class="step"><span>入力内容確認</span></li>
    <li class="step current"><span>送信完了</span></li>
  </ul>
</div>
<div id="mail-form" class="tgt-anchor">
  <table class="table-form block-child--md">
    <tbody>
      <tr class="form-row">
        <th class="form-head"><label for="your_category" onclick="">お問い合わせ項目</label><span class="mark-req">必須</span></th>
        <td class="form-content">
          [checkbox your_category id:fm_category class:radio-inlineblock exclusive use_label_element "一般的なお問い合わせ" "技術に関するお問い合わせ"]
        </td>
      </tr>
      <tr class="form-row">
        <th class="form-head"><label for="fm_name" onclick="">お名前</label><span class="mark-req">必須</span></th>
        <td class="form-content">
          [text* your_name id:fm_name class:form-control]
        </td>
      </tr>
      <tr class="form-row">
        <th class="form-head"><label for="fm_kana" onclick="">フリガナ</label></th>
        <td class="form-content">
          [text your_kana id:fm_kana class:form-control]
        </td>
      </tr>
      <tr class="form-row">
        <th class="form-head"><label for="fm_email" onclick="">メールアドレス</label><span class="mark-req">必須</span></th>
        <td class="form-content">
          <div>
            [email* your_email class:form-control id:fm_email]
          </div>
        </td>
      </tr>
      <tr class="form-row">
        <th class="form-head"><label for="fm_corp" onclick="">会社名</label></th>
        <td class="form-content">
          [text your_corp id:fm_corp class:form-control]
        </td>
      </tr>
      <tr class="form-row">
        <th class="form-head"><label for="fm_content" onclick="">お問い合わせ内容</label><span class="mark-req">必須</span></th>
        <td class="form-content">
          [textarea* your_content x5 class:form-control id:fm_content]
        </td>
      </tr>
    </tbody>
  </table>

  <div class="block-privacy">
    <p class="block-privacy__ttl">
      個人情報の取り扱いについて
    </p>
    <div class="block-privacy__box">
      <p>
        ご記入・ご提出頂いた個人情報は、お客様のお問合わせに対する回答のために利用させて頂きます。
        プライバシー・ポリシーに関しては<a href="../privacy" target="_blank">こちら</a>をご覧ください。
      </p>
    </div>
    <div class="block-privacy__check">[acceptance fm_policy] プライバシーポリシーに同意する [/acceptance]</div>
  </div>

  <div class="form-btns">[back class:btn-back id:btn-back "戻る"][confirm class:btn-submit id:btn-confirm "送信内容を確認する"][submit class:btn-submit id:btn-submit "送信する"]</div>

  <p class="recapture-text">
    このサイトはreCAPTCHAによって保護されており、Googleの<a href="https://policies.google.com/privacy" target="_blank">プライバシーポリシー</a>と<a href="https://policies.google.com/terms" target="_blank">利用規約</a>が適用されます。
  </p>
</div>