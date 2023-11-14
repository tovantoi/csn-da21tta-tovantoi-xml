<<<<<<< HEAD
# Tìm hiểu ngôn ngữ XMl và thiết kế cấu trúc lưu trữ dữ liệu sinh viên minh họa


**Hôm nay em sẽ tìm hiểu về ngôn ngữ XML và cách triển khai**
## **Mục đích**

Dự án này nhằm tìm hiểu về ngôn ngữ XML (Extensible Markup Language) và cách thiết kế một cấu trúc lưu trữ dữ liệu đơn giản cho thông tin sinh viên. XML là một ngôn ngữ đánh dấu linh hoạt được sử dụng rộng rãi để biểu diễn và lưu trữ dữ liệu có cấu trúc. Trong đề tài này, em sẽ sử dụng XML để lưu trữ thông tin về sinh viên, bao gồm tên, ngày sinh, giới tính, địa chỉ, và ngành học.

## **Cấu trúc dữ liệu XML**
Cấu trúc lưu trữ dữ liệu sẽ được xây dựng bằng cách sử dụng các phần tử và thuộc tính trong XML. Dưới đây là một ví dụ về cấu trúc dữ liệu cho thông tin sinh viên:
```
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
Một phần tử students chứa thông tin về tất cả các sinh viên.
Mỗi sinh viên được biểu diễn bằng một phần tử student, có thuộc tính id để định danh duy nhất.
Các thuộc tính như name, birthdate, gender và address lưu trữ thông tin cá nhân của sinh viên.
Phần tử scores chứa điểm số của sinh viên trong các môn học cụ thể.

- Ở trong file index là code mẫu em tìm hiểu được thông qua tìm kiếm các trang tài liệu qua đó em sẽ dựa trên bài code mẫu đó mà tìm hiểu thêm , hiểu được ý nghĩa các dòng code mà tiến hành sửa lại theo đúng đề tài mà em đã chọn.

=======
# Tìm hiểu ngôn ngữ XMl và thiết kế cấu trúc lưu trữ dữ liệu sinh viên minh họa


**Hôm nay em sẽ tìm hiểu về ngôn ngữ XML và cách triển khai**
## **Mục đích**

Dự án này nhằm tìm hiểu về ngôn ngữ XML (Extensible Markup Language) và cách thiết kế một cấu trúc lưu trữ dữ liệu đơn giản cho thông tin sinh viên. XML là một ngôn ngữ đánh dấu linh hoạt được sử dụng rộng rãi để biểu diễn và lưu trữ dữ liệu có cấu trúc. Trong đề tài này, em sẽ sử dụng XML để lưu trữ thông tin về sinh viên, bao gồm tên, ngày sinh, giới tính, địa chỉ, và ngành học.

## **Cấu trúc dữ liệu XML**
Cấu trúc lưu trữ dữ liệu sẽ được xây dựng bằng cách sử dụng các phần tử và thuộc tính trong XML. Dưới đây là một ví dụ về cấu trúc dữ liệu cho thông tin sinh viên:
```
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
Một phần tử students chứa thông tin về tất cả các sinh viên.
Mỗi sinh viên được biểu diễn bằng một phần tử student, có thuộc tính id để định danh duy nhất.
Các thuộc tính như name, birthdate, gender và address lưu trữ thông tin cá nhân của sinh viên.
Phần tử scores chứa điểm số của sinh viên trong các môn học cụ thể.

- Ở trong file index là code mẫu em tìm hiểu được thông qua tìm kiếm các trang tài liệu qua đó em sẽ dựa trên bài code mẫu đó mà tìm hiểu thêm , hiểu được ý nghĩa các dòng code mà tiến hành sửa lại theo đúng đề tài mà em đã chọn.

  Hôm nay ngày 13/11/2023 em đã gần hoàn thành 3 chương của bài báo cáo 

>>>>>>> fcf3a317c24bb554338ead7cbdf9eb660ec6b2fe
