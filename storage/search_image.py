import sys
import torch
import torchvision.transforms as transforms
from torchvision import models
import faiss
import numpy as np
from PIL import Image
import json
import os
os.environ['KMP_DUPLICATE_LIB_OK'] = 'TRUE'
import warnings
warnings.filterwarnings("ignore", category=UserWarning, module="torchvision")

# Load mô hình ResNet50 và FAISS index
model = models.resnet50(pretrained=False)
model = torch.nn.Sequential(*(list(model.children())[:-1]))
model.load_state_dict(torch.load('storage/resnet50.pth', weights_only=True))
model.eval()

# Load FAISS index và tên ảnh
index = faiss.read_index('storage/faiss_index.index')
with open('storage/image_names.txt', 'r') as f:
    image_names = [line.strip() for line in f]

# Transformer xử lý ảnh
transform = transforms.Compose([
    transforms.Resize((224, 224)),
    transforms.ToTensor(),
    transforms.Normalize(mean=[0.485, 0.456, 0.406], std=[0.229, 0.224, 0.225])
])

# Đọc ảnh đầu vào
image_path = sys.argv[1]
image = Image.open(image_path).convert('RGB')
image_tensor = transform(image).unsqueeze(0)

# Trích xuất đặc trưng
with torch.no_grad():
    features = model(image_tensor).flatten().numpy().reshape(1, -1).astype('float32')

# Tìm kiếm hình ảnh tương tự trong FAISS
_, indices = index.search(features, k=5)
similar_images = [image_names[idx] for idx in indices[0]]

# Trả về kết quả JSON
print(json.dumps(similar_images))
