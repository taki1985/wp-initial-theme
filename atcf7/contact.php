<?php

/**
 * Template Name: お問い合わせフォーム
 */


if (!defined('ABSPATH')) {
  exit;
}
?>

<!--お問い合わせ-->

<div id="mailForm" class="mail-form block-child--sm">
  <table class="form-table">
    <tbody>
      <tr class="form-table__row">
        <th class="form-table__head"><label for="your_category" onclick="">エントリー区分</label><span class="mark-req">必須</span></th>
        <td class="form-table__content">
          [radio your_category id:your_category class:radio-block exclusive use_label_element default:1 "新卒採用" "中途採用(職務経歴書をお送りください)" "インターンシップ"]
        </td>
      </tr>

      <tr class="form-table__row">
        <th class="form-table__head"><label for="your_name" onclick="">お名前</label><span class="mark-req">必須</span></th>
        <td class="form-table__content">
          [text* your_name id:your_name class:form-control placeholder "例 : 山田 太郎"]
        </td>
      </tr>

      <tr class="form-table__row">
        <th class="form-table__head"><label for="your_kana" onclick="">フリガナ</label><span class="mark-req">必須</span></th>
        <td class="form-table__content">
          [text* your_kana id:your_kana class:form-control placeholder "例 : ヤマダ タロウ"]
        </td>
      </tr>

      <tr class="form-table__row">
        <th class="form-table__head"><label for="your_tel" onclick="">電話番号</label><span class="mark-req">必須</span></th>
        <td class="form-table__content">
          [tel* your_tel id:your_tel class:form-control placeholder "例 : 03-1234-5678"]
        </td>
      </tr>

      <tr class="form-table__row">
        <th class="form-table__head"><label for="your_mail" onclick="">メールアドレス</label><span class="mark-req">必須</span></th>
        <td class="form-table__content">
          [email* your_email id:your_email class:form-control placeholder "例 : yamada@sample.com"]
        </td>
      </tr>

      <tr class="form-table__row">
        <th class="form-table__head"><label for="your_year" onclick="">生年月日</label><span class="mark-req">必須</span></th>
        <td class="form-table__content">
          <div class="form-row form-ymd">
            <!--日付自動制御-->
            <div class="form-row__col" data-start="-15">
              <div class="form-adornments">
                [select* your_year id:your_year class:js-year class:form-select include_blank]
                <p class="form-adornments__after">年</p>
              </div>
            </div>
            <div class="form-row__col">
              <div class="form-adornments">
                [select* your_month id:your_month class:js-month class:form-select include_blank]
                <p class="form-adornments__after">月</p>
              </div>
            </div>
            <div class="form-row__col">
              <div class="form-adornments">
                [select* your_day id:your_day class:js-day class:form-select include_blank]
                <p class="form-adornments__after">日</p>
              </div>
            </div>
          </div>
        </td>
      </tr>

      <tr class="form-table__row">
        <th class="form-table__head"><label for="your_zip" onclick="">ご住所</label><span class="mark-req">必須</span></th>
        <td class="form-table__content">
          <div class="block-child--sm">
            <div class="form-adornments">
              <p class="form-adornments__before">〒</p>
              [text* your_zip id:your_zip size:15 class:form-control class:input-inline]
            </div>
          </div>
          <div class="block-child--xs">
            [text* your_address id:your_address class:form-control placeholder "※建物名・部屋番号までご入力ください。"]
          </div>
        </td>
      </tr>

      <tr class="form-table__row">
        <th class="form-table__head">履歴書<span class="mark-req">必須</span></th>
        <td class="form-table__content">
          <div class="form-file use-floating-validation-tip">[file* your_file1 id:your_file1 limit:1048576 filetypes:xls|xlsx|doc|docx|pdf]<label for="your_file1" class="wpcf7c-elm-step1">ファイルを選択</label><a class="form-file__delete wpcf7c-elm-step1" style="display:none;"></a></div>
          <div class="block-child--xs">
            <p class="text-note">※1ファイルあたり500KB以下でお願いします。</p>
            <p class="text-note">※ファイルの容量が大きい場合は、データを圧縮するか「その他」にご記入ください。</p>
          </div>
        </td>
      </tr>

      <tr class="form-table__row">
        <th class="form-table__head"><label for="your_content" onclick="">その他</label></th>
        <td class="form-table__content">
          [textarea your_content id:your_content x5 class:form-control placeholder "ご自由にご記入ください"]
        </td>
      </tr>

    </tbody>
  </table>

  <div class="privacy-block block-child--md">
    <p class="privacy-block__title">
      個人情報の取り扱いについて
    </p>
    <div class="privacy-block__box">
      <p>
        ご記入・ご提出頂いた個人情報は、お客様のお問合わせに対する回答のために利用させて頂きます。<br>それ以外に利用することは一切ありません。<br>当社のプライバシーポリシーに関しては<a href="/privacy" target="_blank">こちら</a>をご覧ください。
      </p>
    </div>
    <div class="privacy-block__check">[acceptance your_policy] プライバシーポリシーに同意する [/acceptance]</div>
  </div>

  <div class="form-btns">[back class:btn-back id:btn-back "戻る"][confirm class:btn-submit id:btn-confirm "送信内容を確認する"][submit class:btn-submit id:btn-submit "送信する"]</div>

  <p class="recapture-text">
    このサイトはreCAPTCHAによって保護されており、Googleの<a href="https://policies.google.com/privacy" target="_blank">プライバシーポリシー</a>と<a href="https://policies.google.com/terms" target="_blank">利用規約</a>が適用されます。
  </p>
</div>