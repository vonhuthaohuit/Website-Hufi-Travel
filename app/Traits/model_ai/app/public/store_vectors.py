# -*- coding: utf-8 -*-
import os
from tensorflow.keras.preprocessing import image
from tensorflow.keras.applications.vgg16 import VGG16, preprocess_input
from tensorflow.keras.models import  Model

from PIL import Image
import pickle
import numpy as np

# Ham tao model
def get_extract_model():
    vgg16_model = VGG16(weights="imagenet")
    extract_model = Model(inputs=vgg16_model.inputs, outputs = vgg16_model.get_layer("fc1").output)
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
    print("Xu ly : ", image_path)
    img = Image.open(image_path)
    img_tensor = image_preprocess(img)

    # Trich dac trung
    vector = model.predict(img_tensor)[0]
    # Chuan hoa vector = chia chia L2 norm (tu google search)
    vector = vector / np.linalg.norm(vector)
    return vector




# Dinh nghia thu muc data
current_dir = os.getcwd()

data_folder = os.path.join(current_dir, "frontend/images/tour")

# Khoi tao model
model = get_extract_model()

vectors = []
paths = []

valid_extensions = (".jpg", ".jpeg", ".png", ".gif", ".tiff", ".bmp", ".svg", ".webp", ".ico", ".raw")

for image_path in os.listdir(data_folder):
    if not image_path.lower().endswith(valid_extensions):
        continue
    # Noi full path
    image_path_full = os.path.join(data_folder, image_path)
    # Trich dac trung
    image_vector = extract_vector(model,image_path_full)
    # Add dac trung va full path vao list
    vectors.append(image_vector)
    paths.append(image_path_full)

# save vao file
project_root = os.path.abspath(os.path.join(os.path.dirname(__file__), '../../'))
vector_file = os.path.join(project_root, "app", "public", "vectors.pkl")
path_file = os.path.join(project_root, "app", "public", "paths.pkl")

# Lưu vào thư mục public
pickle.dump(vectors, open(vector_file, "wb"))
pickle.dump(paths, open(path_file, "wb"))

