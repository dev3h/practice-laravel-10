## Những cái đã làm được

## 1 Route

-   Kết hợp cả việc dùng **resource** và **middleware**
-   middleware bao gồm change language, check login

### Route User

-   Thử sử dụng Auth để làm chức năng đăng ký, đăng nhập, đăng xuất
    | # | Method | Route | Des |
    | --- | :----: | -----------------: | -----------------: |
    | 1 | GET | **/auth/login** | open form login |
    | 2 | GET | **/auth/register** | open form register |
    | 3 | POST | **/auth/login** | handle login |
    | 4 | POST | **/auth/register** | handle register |
    | 5 | GET | **/auth/logout/** | handle logout |

-   Hiện tại đang sử dụng Auth nhưng chạy câu lệnh để generate code: php artisan ui:auth nên sẽ không có cái prefix auth. Ngoài ra sẽ có thêm một vài route do auth tự sinh ra như route để verify email cũng như để reset password

    | #   | Method |                        Route |                             Des |
    | --- | :----: | ---------------------------: | ------------------------------: |
    | 1   |  GET   | **email/verify/{id}/{hash}** | link when click is verify email |
    | 2   |  GET   |          **/password/email** |     send mail to reset password |
    | 3   |  POST  |           **password/reset** |                set new password |

### Route Classroom

-   CRUD classroom:
    | # | Method | Route | Des |
    | --- | :----: | ----------------: | ---------------------: |
    | 1 | GET | **/classroom** | get all classroom |
    | 2 | GET | **/classroom/id** | get classroom by id |
    | 3 | POST | **/classroom** | store new classroom |
    | 4 | PUT | **/classroom/id** | update classroom by id |
    | 5 | DELETE | **/classroom/id** | delete classroom by id |

## 2 Component

-   Đã tạo thử được component, thử tạo 1 hình tròn và truyền các params vào trong component đó

## 3 Upload file

-   Đã thử được upload file ảnh vào trong storage và link từ storage sang public

## 4 Helpers

-   Thử tạo ra 1 hàm helper đơn giản để sử dụng, trong `app/helpers/php`

## 5 Notification

-   Test thử sau khi đăng ký xong thì sẽ gửi 1 mail với thông báo chào mừng

## 6 Event, Listener

-   Thử tạo 1 cái nút order sau đó khi bấm vào nút đó thì sẽ bắt sự kiện để tiến hành gửi mail. Listener sẽ hứng những cái mà thằng event gửi (chưa hoàn thiện do chưa tạo 1 mail với lênh `php artisan mail`)

## 7 Hash

-   Test hash một chuỗi và so sánh chuỗi hash với chuỗi người dùng nhập vào

## 8 Validate, csrf token, middleware

-   Sử dụng csrf token để tránh sql injection trong form method post, put, delete
-   Tạo 1 request validate cho ClassroomController, thử viết validate trong controller mà không tạo request
-   Thử viết middleware trong controller, viết ở hàm constructor cho toàn bộ method

## 9 Language

-   Thay đổi ngôn ngữ của ứng dụng với en và vi

## 10 Console

-   Thử tạo ra 1 command cho viết khi chạy artisan thì sẽ thực thi command tạo đó. Command tạo là thay thế email có 1 đuôi bất kì sang đuôi gmail.com

## 11 Session

-   Thử tạo 1 session, lấy session đó ra và xóa session đó đi

## 12 Logging

-   Thử viết 1 log đơn giản để hiển thị user name sau khi đăng nhập xong
## 13 Relationship
- Taọ được mối quan hệ giữa Classroom và Student. Sau đó từ student lấy được các thông tin của classroom mà không cần dùng join
## 14 Seeder và factory
- Fake một loạt dữ liệu lớn cho User, Classroom, Student để chuẩn bị cho việc pagination
## 15 Pagination
- Tiến hành phân trang cho dữ liệu, ui sử dụng là pagination của tailwindcss, fix được lỗi chỉ hiện 2 nút prev và next mặc dù không dùng simplePagination
## 16 Eloquent, Eloquent Collection
- Sử dụng được các phương thức của eloquent hỗ trợ để làm CRUD, biết cách tạo global scope, local scope. Thử thay đổi tên mới cho table, khóa chính, làm được xóa mềm
- Sử dụng được những phương thức mà eloquent collection cung cấp
## 17 Accesors và mutators
- Sử dụng accesors để format lại cột id của classroom trước khi hiển thị cho người dủng và mutators để format dữ liệu cho name của classroom trước khi lưu vào DB
## 18 socialite
- Ap dụng login với github
## 19 Mail
- Send mail
## 20 API Resource
- Create API get student and classroom
## 21 Serialization
- Thử chuyển model collection sang array hoặc sang chuỗi json

