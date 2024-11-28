import sys
import torch
import torchvision.transforms as transforms
from torchvision import models
import faiss
import numpy as np
from PIL import Image
import json
import os

# Đảm bảo không có cảnh báo không cần thiết
os.environ['KMP_DUPLICATE_LIB_OK'] = 'TRUE'
import warnings
warnings.filterwarnings("ignore", category=UserWarning, module="torchvision")

# Kiểm tra và tải mô hình ResNet50
model = models.resnet50(pretrained=False)
model = torch.nn.Sequential(*(list(model.children())[:-1]))  # Bỏ lớp phân loại cuối cùng

# Đường dẫn tệp mô hình và FAISS index
# Sử dụng os.path.join để tạo đường dẫn đúng cho mô hình và FAISS index
storage_path = os.path.join(os.getcwd(), 'storage', 'app', 'public')

model_path = os.path.join(storage_path, 'resnet50.pth')
if os.path.exists(model_path):
    model.load_state_dict(torch.load(model_path, weights_only=True))
else:
    raise FileNotFoundError(f"Mô hình không tìm thấy: {model_path}")
model.eval()

# Kiểm tra và tải FAISS index
index_path = os.path.join(storage_path, 'faiss_index.index')  # Đường dẫn tuyệt đối tới FAISS index
if os.path.exists(index_path):
    index = faiss.read_index(index_path)
else:
    raise FileNotFoundError(f"FAISS index không tìm thấy: {index_path}")

# Tải danh sách tên ảnh
image_names_path = os.path.join(storage_path, 'image_names.txt')  # Đường dẫn tuyệt đối tới tên ảnh
if os.path.exists(image_names_path):
    with open(image_names_path, 'r') as f:
        image_names = [line.strip() for line in f]
else:
    raise FileNotFoundError(f"Tên ảnh không tìm thấy: {image_names_path}")

# Transformer để chuẩn bị ảnh
transform = transforms.Compose([
    transforms.Resize((224, 224)),  # Resize ảnh về kích thước 224x224
    transforms.ToTensor(),
    transforms.Normalize(mean=[0.485, 0.456, 0.406], std=[0.229, 0.224, 0.225])
])

# Đọc ảnh đầu vào từ đường dẫn truyền vào
image_path = sys.argv[1]  # Đảm bảo rằng đường dẫn ảnh được truyền vào
if os.path.exists(image_path):
    image = Image.open(image_path).convert('RGB')
else:
    raise FileNotFoundError(f"Ảnh không tìm thấy: {image_path}")

image_tensor = transform(image).unsqueeze(0)  # Biến ảnh thành tensor và thêm một chiều batch

# Trích xuất đặc trưng từ mô hình
with torch.no_grad():
    features = model(image_tensor).flatten().numpy().reshape(1, -1).astype('float32')

# Tìm kiếm hình ảnh tương tự trong FAISS
k = 5  # Số lượng ảnh tương tự cần tìm
_, indices = index.search(features, k)

# Lấy tên các ảnh tương tự
similar_images = [image_names[idx] for idx in indices[0]]

# Trả về kết quả dưới dạng JSON
print(json.dumps(similar_images))
