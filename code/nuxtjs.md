## install NuxtJS
tham khảo: https://nuxtjs.org/guide/installation

```
docker-compose exec --user=node nuxtjs bash
npx create-nuxt-app .
```

nếu có lỗi không tạo được project thì xem cách fix ở đây https://github.com/nuxt/create-nuxt-app/issues/383#issuecomment-569236302

```
cd /var/www
npm init nuxt-app .
```

làm theo các bước để hoàn tất quá trình khởi tạo project


Sau khi cài đặt xong chạy lệnh sau để build project
```
npm run dev
```

truy cập vào http://localhost:3000/ để kiểm tra kết quả cài đặt