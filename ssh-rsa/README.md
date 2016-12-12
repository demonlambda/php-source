openssl 公私钥加解密

1.构造参数
    publicKey:      string 公钥(如果是一个文件，可以先用file_get_contents获取)
    privateKey:     string 私钥(如果是一个文件，可以先用file_get_contents获取)
    content:        string 待加密或解密的内容

2.提供的方法
    publicKeyEncrypt:   计算通过公钥加密后的结果
    publicKeyDecrypt:   计算通过公钥解密后的结果
    privateKeyEncrypt:   计算通过私钥加密后的结果
    privateKeyDecrypt:   计算通过私钥解密后的结果

3.例子:
    //通过公钥加密
    $config = ['publicKey' => $publicKey, 'content' => $content];
    $ssh = new SshRsa();
    $ssh->publicKeyEncrypt()
