import boto3
import os
import shutil
print('Initializing LocalStack resources...')
# Connect to LocalStack
s3 = boto3.client('s3', endpoint_url='http://localhost:4566', aws_access_key_id='dummy', aws_secret_access_key='dummy')

# Create the bucket
bucket_name = 'website-data'
s3.create_bucket(Bucket=bucket_name)

# Create folders (S3 does not have actual folders, but you can create empty objects with folder-like keys)
s3.put_object(Bucket=bucket_name, Key='local-data/')
s3.put_object(Bucket=bucket_name, Key='users-pics/')

# Path to the source directory
source_dir = '/init-data'

# Destination bucket and folder
destination_folder = 'local-data/'

# Function to upload files to S3
def upload_to_s3(file_path, s3_key):
    s3.upload_file(file_path, bucket_name, s3_key)

# Walk through the source directory
for root, dirs, files in os.walk(source_dir):
    print(f'Uploading files from {root}')
    for file in files:
        print(f'Uploading {file}')
        file_path = os.path.join(root, file)
        relative_path = os.path.relpath(file_path, source_dir)
        s3_key = os.path.join(destination_folder, relative_path).replace("\\", "/")
        upload_to_s3(file_path, s3_key)