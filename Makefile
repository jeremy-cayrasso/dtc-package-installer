dist:
	./dist

rpm:
	$(MAKE) dist
	VERS=`head -n 1 debian/changelog | cut -d'(' -f2 | cut -d')' -f1 | cut -d'-' -f1` ; \
	PKGNAME=`head -n 1 debian/changelog | cut -d' ' -f1` ; \
	cd .. ; rpmbuild -ta $${PKGNAME}-$${VERS}.tar.gz

deb:
	if [ -z $(SIGN)"" ] ; then \
		./deb ; \
	else \
		./deb --sign ; \
	fi

.PHONY: dist rpm deb
