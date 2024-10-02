# guzzle-bug-report

### Error happening: "LogicException: The promise is already rejected"

## Description
This repository is a (possible) bug report for the guzzlehttp/guzzle repository.
Such error happens randomly when sending lots of requests in parallel and when these request return non-successful status code:

```
LogicException: The promise is already rejected. in /Users/ilyayatsenko/my/guzzle-bug-report/vendor/guzzlehttp/promises/src/Promise.php on line 131

```

## Steps to reproduce

Run index.php file in the root of the repository. Observe the error.

Possibly, count of concurrent requests should be increased to reproduce the error.
With current count of concurrent requests (400) it happens every single time on my local machine. On real project it was randomly reproducible with much less count of concurrent requests (up to 100).

**PHP version: 8.3.11**


**Curl version:**
```
curl 8.10.1 (aarch64-apple-darwin23.4.0) libcurl/8.10.1 OpenSSL/3.3.2 (SecureTransport) zlib/1.2.12 brotli/1.1.0 zstd/1.5.6 AppleIDN libssh2/1.11.0 nghttp2/1.63.0 librtmp/2.3
Release-Date: 2024-09-18
Protocols: dict file ftp ftps gopher gophers http https imap imaps ipfs ipns ldap ldaps mqtt pop3 pop3s rtmp rtsp scp sftp smb smbs smtp smtps telnet tftp
Features: alt-svc AsynchDNS brotli GSS-API HSTS HTTP2 HTTPS-proxy IDN IPv6 Kerberos Largefile libz MultiSSL NTLM SPNEGO SSL threadsafe TLS-SRP UnixSockets zstd
```

Also reproducible in container with curl version:
```
curl 8.9.1 (aarch64-alpine-linux-musl) libcurl/8.9.1 OpenSSL/3.3.2 zlib/1.3.1 brotli/1.1.0 zstd/1.5.6 c-ares/1.28.1 libidn2/2.3.7 libpsl/0.21.5 nghttp2/1.62.1
Release-Date: 2024-07-31
Protocols: dict file ftp ftps gopher gophers http https imap imaps ipfs ipns mqtt pop3 pop3s rtsp smb smbs smtp smtps telnet tftp ws wss
Features: alt-svc AsynchDNS brotli HSTS HTTP2 HTTPS-proxy IDN IPv6 Largefile libz NTLM PSL SSL threadsafe TLS-SRP UnixSockets zstd
```