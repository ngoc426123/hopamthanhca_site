<?php
use App\Models\Cat;
use App\Models\Type;
use App\Models\Cattype;

class Header {
  public static function getCat() {
    $catModel = new Cat();
    $typeModel = new Type();
    $cattypeModel = new Cattype();
    $typeDieuBaiHat = $typeModel->where('type_slug', 'dieu-bai-hat')->find();
    $idTypeDieuBaihat = $typeDieuBaiHat[0]['id'];
    $listIdDieuBaiHat = $cattypeModel->where('id_type', $idTypeDieuBaihat)->findAll();
    $listDieuBaiHat = [];

    foreach ($listIdDieuBaiHat as $value) {
      $listDieuBaiHat[] = $value['id_cat'];
    }

    return $catModel->whereIn('id', $listDieuBaiHat)->findAll();
  }
}

$headerClass = new Header();
?>

<header class="header">
  <div class="header__main">
    <div class="comp-wrapper">
      <div class="header__left">
        <div class="header__logo">
          <a href="<?= base_url(); ?>" title="Hợp Âm Thánh Ca">
            <img src="<?= base_url("images/logo.svg"); ?>" alt="logo">
          </a>
      </div>
      </div>
      <div class="header__tools">
        <div class="header__menu"data-menumobile>
          <div class="header__menuToggle"data-menumobile-toggle><span></span><span></span><span></span></div>
          <div class="header__menuOverlay"data-menumobile-overlay></div>
          <div class="header__menuDropdown"data-menumobile-dropdown>
          <span class="header__menuBoxover" data-menumobile-boxover></span>
            <ul>
              <li><a href="<?= base_url(); ?>" title="Trang chủ">Trang chủ</a></li>
              <li><a href="<?= base_url('gioi-thieu'); ?>" title="Giới thiệu">Giới thiệu</a></li>
              <li><a href="<?= base_url('danh-muc'); ?>"><span>Danh mục</span></a>
                <ul>
                  <li><a href="<?= base_url('bang-chu-cai'); ?>" title="Bảng chữ cái">Bảng chữ cái</a></li>
                  <li><a href="<?= base_url('chuyen-muc'); ?>" title="Chuyên mục">Chuyên mục</a></li>
                  <li><a href="<?= base_url('tac-gia'); ?>" title="Tác giả">Tác giả</a></li>
                </ul>
              </li>
              <li class="noPos">
                <a href="<?= base_url('dieu-bai-hat'); ?>" title="Điệu nhạc"> <span>Điệu nhạc</span></a>
                <ul class="menuMega">
                <?php foreach ($headerClass::getCat() as $value) { ?>
                  <li>
                    <a href="<?= base_url('dieu-bai-hat/' . $value['cat_slug']); ?>" title="<?= $value['cat_name']; ?>">
                      <span><?= $value['cat_name']; ?></span>
                    </a>
                  </li>
                <?php } ?>
                </ul>
              </li>
              <li><a href="<?= base_url("thanh-ca-hang-tuan"); ?>" title="Hợp âm">Thánh ca hàng tuần</a></li>
              <li><a href="<?= base_url("sheet-nhac"); ?>" title="Sheet nhạc">Sheet nhạc</a></li>
              <li class="d-block d-md-none"><a href="<?= base_url("bai-hat"); ?>" title="Bài hát">Bài hát</a></li>
              <li class="d-block d-md-none"><a href="<?= base_url("danh-sach-hop-am"); ?>" title="Hợp âm">Hợp âm</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header__search" data-search>
    <div class="comp-wrapper">
      <div class="header__search-title">Cùng tìm kiếm bài hát bạn thích nhất</div>
      <div class="header__search-form" data-search-form>
        <input
          type="text"
          name="query"
          id="searchDesktop"
          autocomplete="off"
          placeholder="Nhập tên bài hát, từ khóa tìm kiếm..."
          data-search-input
          data-action='tim-kiem'
        >
        <div class="header__search-loading"><img src="<?= base_url('images/loading-search.svg') ?>" alt="Loading search"/></div>
        <div class="header__search-suggess">
          <ul data-suggess></ul>
        </div>
      </div>
      <div class="header__search-note">
        <p>Tìm với tên bài hát: Ca vang tình yêu Chúa, Tình yêu Thiên Chúa</p>
        <p>Tìm với lời đầu tiên của bài hát: "Đời con là những nốt nhạc thiêng"</p>
        <p> Nhập bài hát đầy đủ dấu và chữ, không ghi tắt.</p>
      </div>
    </div>
  </div>
</header>