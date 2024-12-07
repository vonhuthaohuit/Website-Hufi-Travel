import sys
import math
import os
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'
import json


from tensorflow.keras.preprocessing import image
from tensorflow.keras.applications.vgg16 import VGG16, preprocess_input
from tensorflow.keras.models import Model

from PIL import Image
import pickle
import numpy as np
os.environ['KMP_DUPLICATE_LIB_OK'] = 'TRUE'
import warnings
warnings.filterwarnings("ignore")


# Ham tao model
def get_extract_model():
    vgg16_model = VGG16(weights="imagenet")
    extract_model = Model(inputs=vgg16_model.inputs, outputs=vgg16_model.get_layer("fc1").output)
    return extract_model

# Ham tien xu ly, chuyen doi hinh anh thanh tensor
def image_preprocess(img):
    img = img.resize((224,224))
    img = img.convert("RGB")
    x = image.img_to_array(img)
    x = np.expand_dims(x, axis=0)
    x = preprocess_input(x)
    return x

def extract_vector(model, image_path):
    img = Image.open(image_path)
    img_tensor = image_preprocess(img)

    # Trich dac trung
    vector = model.predict(img_tensor, verbose=0)[0]
    # Chuan hoa vector = chia chia L2 norm
    vector = vector / np.linalg.norm(vector)
    return vector

# Nhận đường dẫn ảnh từ tham số command line
if len(sys.argv) < 2:
    print("Please provide the search image path.")
    sys.exit(1)

search_image = sys.argv[1]  # Đường dẫn ảnh sẽ được truyền vào từ Laravel

# Khởi tạo model
model = get_extract_model()

# Trích xuất đặc trưng từ ảnh tìm kiếm
search_vector = extract_vector(model, search_image)

# Load các vector đã lưu
vectors = pickle.load(open(os.path.join(os.path.dirname(__file__), 'vectors.pkl'), "rb"))
paths = pickle.load(open(os.path.join(os.path.dirname(__file__), "paths.pkl"), "rb"))

# Tính toán khoảng cách
distance = np.linalg.norm(vectors - search_vector, axis=1)

# Lấy K ảnh gần nhất
K = 16
ids = np.argsort(distance)[:K]

# Lọc kết quả với khoảng cách < 1
filtered_ids = [id for id in ids if distance[id] < 1]

# Tạo output
nearest_image = [(paths[id], distance[id]) for id in filtered_ids]

# Xuất kết quả dưới dạng JSON
result = [{"path": paths[id], "distance": float(distance[id])} for id in filtered_ids]

print(json.dumps(result))
