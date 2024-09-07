<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hợp Âm Thánh Ca - Cảnh Báo</title>
  <link href="<?= base_url("css/style.min.css"); ?>" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-6">
        <div class="py-5 px-3 bg-white rounded-4">
          <div class="row justify-content-center mb-4">
            <div class="col-2">
              <img class="" src="<?= base_url('/images/warning.png') ?>" alt="Warning icon">
            </div>
          </div>
          <div class="p-4 bg-danger rounded-3 text-white text-center fw-light fs-6 mb-4">Cảnh báo - đường dẫn không chính xác !</div>
          <div class="fs-7">
            <p class="p-0 fw-bold">Xin chào người dùng</p>
            <p class="p-0">Chúng tôi phát hiện bạn truy cập một đường dẫn bên chúng tôi và đường dẫn này không tồn tại hoặc gây nguy hiểm cho phía người dùng.</p>
            <p class="p-0 mb-4">Bạn có thể nhấn nút quay lại phía dưới để quay về trang chủ hoặc liên hệ với email bên dưới để chúng tôi hỗ trợ</p>
            <p class="p-0 mb-5 text-center">
              <a class="btn btn-primary py-3 px-5" href="<?= base_url('/') ?>">Quay lại</a>
            </p>
            <p class="p-0">Hoặc liên hệ email: <a class="text-info" href="mailto:<?= esc($pageinit['email']) ?>"><?= esc($pageinit['email']) ?></a></p>
            <p class="p-0">Xin cảm ơn.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>