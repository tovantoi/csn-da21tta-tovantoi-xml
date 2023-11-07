# Tìm hiểu ngôn ngữ XML và Thiết kế Cấu Trúc Lưu Trữ Dữ Liệu Sinh Viên Minh Họa
## **Mục đích**

Dự án này nhằm tìm hiểu về ngôn ngữ XML (Extensible Markup Language) và cách thiết kế một cấu trúc lưu trữ dữ liệu đơn giản cho thông tin sinh viên. XML là một ngôn ngữ đánh dấu linh hoạt được sử dụng rộng rãi để biểu diễn và lưu trữ dữ liệu có cấu trúc. Trong đề tài này, tôi sẽ sử dụng XML để lưu trữ thông tin về sinh viên, bao gồm tên, ngày sinh, giới tính, địa chỉ, và ngành học.

## **Cấu trúc của XML**

Cấu trúc lưu trữ dữ liệu trong XML sẽ được xây dựng bằng cách sử dụng các phần tử và thuộc tính trong XML. Dưới đây là một ví dụ về cấu trúc dữ liệu cho thông tin sinh viên:


```c

<students>
    <student id="1">
        <name>Nguyen Van A</name>
        <birthdate>1998-05-15</birthdate>
        <gender>Male</gender>
        <address>
            <street>123 Main Street</street>
            <city>Hanoi</city>
            <zip>100000</zip>
        </address>
        <scores>
            <math>95</math>
            <physics>87</physics>
            <chemistry>92</chemistry>
        </scores>
    </student>
    <!-- Các sinh viên khác -->
</students>
```
