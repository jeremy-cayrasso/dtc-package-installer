Name: dtc-package-installer
Version: __VERSION__
Release: 0.1
License: LGPL
Group: System Environment/Daemons
URL: http://www.gplhost.com/software-mysqmail.html
Source: mysqmail-%{version}.tar.gz
BuildRoot:%{_tmppath}/%{name}-%{version}-%{release}-root
BuildRequires: make gcc dotconf-devel mysql-devel

Requires: dtc-core
Summary: Adds package installer apps to DTC
Group: System Environment/Daemons
%description
This is a collection of apps that are done for
the package installer of DTC.

%prep
%setup

%build
make

%install

set -e

%{__rm} -rf %{buildroot}
mkdir -p %{buildroot}
cp -rfv nuked-klan-gamer nuked-klan-sp drupal joomla oscommerce oscommerce-creloaded phpbb phpnuke phpsurveyor smf spip vtiger wanewsletter wordpress %{buildroot}

%pre

%clean
%{__rm} -rf %{buildroot} 2>&1 >/dev/null

%files
%defattr(-, root, root, -)

%changelog
* Sat Aug 08 2009 Thomas Goirand (zigo) <thomas@goirand.fr> 0.24.8-0.1
- Initial Package
