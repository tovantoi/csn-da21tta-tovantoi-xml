#Tô Văn Tới
##Email: tovantoi2003@gmail.com
##SDT: 0359272229



#Tổng quan về ngôn ngữ XML
##khái niệm
XML (**eXtensible Markup Language**) là một ngôn ngữ đánh dấu dùng để lưu trữ và truyền tải dữ liệu. Được phát triển bởi W3C (**World Wide Web Consortium**), XML cho phép người dùng tự định nghĩa các thẻ tùy ý để tạo ra cấu trúc dữ liệu linh hoạt và dễ dàng để đọc bởi con người và các ứng dụng máy tính.

**Đặc điểm chính của XML:**

**Tự mô tả:** XML cho phép người dùng tự định nghĩa cấu trúc dữ liệu thông qua việc tạo các thẻ tùy ý, mỗi thẻ đều có thể chứa dữ liệu và các thuộc tính.

Độc lập với nền tảng: Dữ liệu XML có thể được truyền tải và lưu trữ trên nhiều nền tảng và hệ điều hành khác nhau mà không bị ràng buộc bởi các yêu cầu cụ thể.

**Hỗ trợ Unicode:** XML hỗ trợ Unicode, cho phép sử dụng các ký tự từ nhiều ngôn ngữ và bộ mã hóa khác nhau.

**Cấu trúc cú pháp đơn giản:** Cú pháp của XML rất linh hoạt và dễ hiểu, bắt đầu bằng thẻ mở <tag> và kết thúc bằng thẻ đóng </tag>, bao quanh dữ liệu.

**Hỗ trợ cho cấu trúc dữ liệu phức tạp:** XML cho phép xây dựng cấu trúc dữ liệu phức tạp bằng cách lồng ghép các thẻ và tạo mối quan hệ giữa chúng.

##Cách sử dụng XML

**XML được sử dụng rộng rãi trong nhiều lĩnh vực:**

**Lưu trữ dữ liệu:** XML thường được sử dụng để lưu trữ cấu trúc dữ liệu như cài đặt, cấu hình, hoặc dữ liệu có cấu trúc trong các ứng dụng.
Ví dụ, một cơ sở dữ liệu của các sách có thể được biểu diễn trong XML như sau:

xml
```
<library>
  <book>
    <title>Đắc Nhân Tâm</title>
    <author>Dale Carnegie</author>
    <genre>Tâm Lý - Phát Triển Bản Thân</genre>
  </book>
  <book>
    <title>Nghệ Thuật Bán Hàng</title>
    <author>Zig Ziglar</author>
    <genre>Kỹ Năng Bán Hàng</genre>
  </book>
</library>
``

**Truyền tải dữ liệu:** XML là một phần quan trọng trong việc truyền tải dữ liệu qua mạng, đặc biệt trong các giao thức như SOAP (Simple Object Access Protocol) và RESTful APIs.

**Tài liệu chuẩn:** XML được sử dụng để tạo các tài liệu chuẩn như XHTML, OpenDocument, và RSS để chia sẻ thông tin và dữ liệu trên internet.

##Cách truy vấn và thao tác với XML

**XPath:** Ngôn ngữ để truy vấn và điều hướng qua các phần tử và thuộc tính trong tài liệu XML.

**XQuery:** Ngôn ngữ truy vấn dùng để trích xuất thông tin từ tài liệu XML.

**DOM và SAX:** DOM (**Document Object Model**) cung cấp cấu trúc dữ liệu dựa trên cây cho XML, trong khi SAX (**Simple API for XML**) duyệt qua tài liệu XML dựa trên sự kiện.

XML đóng vai trò quan trọng trong việc đảm bảo tương tác linh hoạt giữa các hệ thống và lưu trữ dữ liệu cấu trúc.