# 🧩 Customer CRM Case Study (Laravel 12)

## 🚀 Proje Tanımı
Bu proje, müşteri yönetim sistemini (Customer CRM) geliştirmeyi amaçlar.  
Kullanıcılar giriş yaptıktan sonra müşteri kayıtlarını ekleyebilir, güncelleyebilir, silebilir ve listeleyebilirler.  

Uygulama **Laravel 12** ile geliştirilmiştir ve **OOP, SOLID, Clean Code** prensiplerine uygun katmanlı mimariyle yapılandırılmıştır.  
Veri tabanı işlemleri `Repository` ve `Service` katmanlarıyla soyutlanmıştır.

---

## ⚙️ Kurulum Adımları

### 1️⃣ Depoyu klonlayın
```bash
git clone https://github.com/erdemaltu/PHP-Laravel-CustomerCrm.git
cd PHP-Laravel-CustomerCrm
```

### 2️⃣ Bağımlılıkları yükleyin
```bash
composer install
npm install && npm run build
```

### 3️⃣ .env dosyasını oluşturun
```bash
cp .env.example .env
```
Veritabanı bağlantı ayarlarını yapın (örnek):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=customer_crm
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Uygulama anahtarını oluşturun
```bash
php artisan key:generate
```

### 5️⃣ Migrasyonları ve seed işlemlerini çalıştırın
```bash
php artisan migrate --seed
```

### 6️⃣ Geliştirme sunucusunu başlatın
```bash
php artisan serve
```

Uygulama:  
👉 [http://localhost:8000](http://localhost:8000)

---

## 🏗️ Geliştirme Aşamaları

### **1. Proje Kurulumu**
Laravel 12 kurulumu tamamlandı.  
Kimlik doğrulama (login/register) işlemleri manuel olarak oluşturuldu.

---

### **2. Katmanlı Mimari**
Proje katmanlı bir yapıya sahiptir:
- **Controller:** HTTP isteklerini yönlendirir.  
- **Service:** İş mantığını barındırır.  
- **Repository:** Veritabanı erişimini soyutlar.  
- **Model:** Veritabanı tablosunu temsil eder.

Bu yapı sayesinde **SOLID prensipleri** uygulanmıştır:
- **S**ingle Responsibility → Her sınıf tek görev yapar.  
- **O**pen/Closed → Yeni özellik eklenebilir, mevcut kod değişmeden kalır.  
- **L**iskov Substitution → Interface’ler sayesinde farklı implementasyonlar kolayca değiştirilebilir.  
- **I**nterface Segregation → Her interface, ihtiyaca uygun küçük yapılarda tutulur.  
- **D**ependency Inversion → Controller doğrudan Repository’ye değil, Service aracılığıyla erişir.

---

### **3. Veritabanı Tasarımı**
Tablo: `customers`

| Alan | Tip | Açıklama |
|------|-----|-----------|
| id | bigint | Primary Key |
| customer_code | string | Otomatik müşteri kodu (örnek: MTS0001) |
| name | string | Müşteri adı |
| address | string | Müşteri adresi |
| phone | string | Telefon |
| email | string | E-posta |
| created_by | int | Kaydı oluşturan kullanıcı |
| updated_by | int | Kaydı güncelleyen kullanıcı |
| timestamps | - | Laravel varsayılan alanları |

Indexleme yapılmıştır:
- `customer_code`
- `name`
- `phone`
- `email`

Bu alanlar sorgularda sık kullanıldığı için performans artırır.

---

### **4. CRUD İşlemleri**
Müşteri ekleme, listeleme, güncelleme, silme işlemleri tamamlanmıştır.  
Tüm işlemler `CustomerController` → `CustomerService` → `CustomerRepository` zinciriyle yürütülür.

#### Transaction Kullanımı
`create`, `update`, `delete` işlemleri `DB::transaction()` içinde yapılır.  
Bu sayede bir işlem yarım kalırsa veritabanı eski haline döner.

---

### **5. DataTables Entegrasyonu**
- jQuery DataTables kullanılarak server-side veri yükleme sağlanmıştır.  
- Arama, sıralama ve sayfalama işlemleri backend tarafından yapılır.  
- 10K kayıt için performanslı bir yapı sağlanmıştır.  

**Performans Optimizasyonu:**
- “Tümü” seçeneğinde en fazla **1000 kayıt** yüklenir.  
- Kullanıcıya Bootstrap bilgi kutusu gösterilir.  
- Geri kalan kayıtlar sayfalama ile görüntülenir.

---

### **6. Arayüz (UI)**
- **Bootstrap 5** kullanıldı.  
- Responsive (mobil uyumlu) yapı sağlandı.  
- DataTables Türkçe dil desteği aktif (`tr.json`).  

---

### **7. Validasyon & Güvenlik**
- `CustomerStoreRequest` ve `CustomerUpdateRequest` sınıflarıyla form verisi doğrulanır.  
- `auth` middleware ile sadece giriş yapmış kullanıcılar işlem yapabilir.  
- CSRF koruması aktif.

---

### **8. Test Süreci**
- Tüm CRUD işlemleri test edilmiştir.  
- Yetkisiz erişimlerde 403 hatası döndüğü doğrulanmıştır.  
- 10k kayıtlı test verisiyle performans testleri yapılmıştır.

---

## 📁 Klasör Yapısı (Özet)
```
app/
 ├── Http/
 │   └── Controllers/Customers/CustomerController.php
 ├── Services/CustomerService.php
 ├── Repositories/
 │   ├── Contracts/CustomerRepositoryInterface.php
 │   └── Eloquent/EloquentCustomerRepository.php
 └── Models/Customer.php
resources/views/customers/
 ├── index.blade.php
 ├── create.blade.php
 └── edit.blade.php
```

---

## 👨‍💻 Kullanılan Teknolojiler
- **Laravel 12**
- **PHP 8.4**
- **MySQL**
- **Bootstrap 5**
- **jQuery + DataTables**
- **OOP / SOLID / Clean Code** prensipleri

---

## 🧠 Sonuç
Bu proje:
- Yüksek veri hacmiyle performanslı çalışır.  
- Genişletilebilir ve test edilebilir bir mimariye sahiptir.  
- Kod okunabilirliği ve sürdürülebilirliği yüksektir.

---

## 📜 Lisans
Bu proje sadece değerlendirme ve öğrenme amaçlı geliştirilmiştir.
