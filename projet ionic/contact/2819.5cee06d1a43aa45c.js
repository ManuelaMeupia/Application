"use strict";(self.webpackChunkapp=self.webpackChunkapp||[]).push([[2819],{2819:(m,i,o)=>{o.r(i),o.d(i,{AcceuilPage:()=>f});var d=o(177),l=o(4341),r=o(1626),n=o(3953),g=o(8986);let f=(()=>{var a;class s{constructor(e,t){this.route=e,this.http=t,this.id=null,this.nom=null,this.telephone=null,this.unreadCount=0}ngOnInit(){this.route.queryParams.subscribe(e=>{this.id=e.id,this.nom=e.nom,this.telephone=e.telephone,console.log("ID:",this.id),console.log("Nom:",this.nom),console.log("Telephone:",this.telephone),this.id&&this.fetchUnreadNotifications()})}fetchUnreadNotifications(){this.http.get(`http://localhost/api/notifications.php?id=${this.id}`).subscribe(e=>{e.success?(this.unreadCount=e.unread_count,console.log(`Unread notifications: ${this.unreadCount}`)):console.error("API error:",e.message)},e=>{console.error("Error fetching unread notifications:",e)})}}return(a=s).\u0275fac=function(e){return new(e||a)(n.rXU(g.nX),n.rXU(r.Qq))},a.\u0275cmp=n.VBU({type:a,selectors:[["app-acceuil"]],standalone:!0,features:[n.aNF],decls:41,vars:12,consts:[["lang","en"],["charset","UTF-8"],["name","viewport","content","width=device-width, initial-scale=1.0"],["rel","stylesheet","href",n.wXG`https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css`],[1,"dashboard-container"],[1,"dashboard-header"],[1,"user-name"],[1,"dashboard-menu"],[3,"href"],[1,"fas","fa-address-book"],[1,"fas","fa-database"],[1,"fas","fa-user"],["href","apropos"],[1,"fas","fa-info-circle"],[1,"fas","fa-bell"],["href","home"],[1,"fas","fa-sign-out-alt"],["href","notez"],[1,"fas","fa-star"],[1,"scrolling-text"],[1,"icons"],[1,"fab","fa-whatsapp"],[1,"fab","fa-telegram"]],template:function(e,t){1&e&&(n.j41(0,"html",0)(1,"head"),n.nrm(2,"meta",1)(3,"meta",2),n.j41(4,"title"),n.EFF(5,"Administration Panel"),n.k0s(),n.nrm(6,"link",3),n.k0s(),n.j41(7,"body")(8,"div",4)(9,"div",5)(10,"div",6),n.EFF(11),n.k0s()(),n.j41(12,"div",7)(13,"a",8),n.nrm(14,"i",9),n.EFF(15," Mes contacts"),n.k0s(),n.j41(16,"a",8),n.nrm(17,"i",10),n.EFF(18," Mes donn\xe9es"),n.k0s(),n.j41(19,"a",8),n.nrm(20,"i",11),n.EFF(21," Mon profil"),n.k0s(),n.j41(22,"a",12),n.nrm(23,"i",13),n.EFF(24," \xc0 propos de nous"),n.k0s(),n.j41(25,"a",8),n.nrm(26,"i",14),n.EFF(27),n.k0s(),n.j41(28,"a",15),n.nrm(29,"i",16),n.EFF(30," D\xe9connexion"),n.k0s(),n.j41(31,"a",17),n.nrm(32,"i",18),n.EFF(33," Notez-nous"),n.k0s()()(),n.j41(34,"div",19),n.EFF(35," Bienvenue dans MY apps | Statuts | Rendez d\xe9sormais vos statuts WhatsApp accessibles "),n.k0s(),n.j41(36,"div",20),n.nrm(37,"i",21)(38,"i",22)(39,"i",18)(40,"i",11),n.k0s()()()),2&e&&(n.R7$(11),n.SpI("Welcome, ",t.nom," !"),n.R7$(2),n.yjJ("href","contact?id=",t.id,"&nom=",t.nom,"&numero=",t.telephone,"",n.B4B),n.R7$(3),n.Mz_("href","import?id=",t.id,"",n.B4B),n.R7$(3),n.Mz_("href","registre?id=",t.id,"",n.B4B),n.R7$(6),n.Mz_("href","notifs?id=",t.id,"",n.B4B),n.R7$(2),n.SpI(" Notifications non lues ",t.unreadCount," "))},dependencies:[d.MD,l.YN,r.q1],styles:["body[_ngcontent-%COMP%]{margin:0;padding:0;font-family:Arial,sans-serif;background:linear-gradient(135deg,#ffffffb3,#add8e6b3),url(https://example.com/lightning-bg.jpg) no-repeat center center fixed;background-size:cover}.container[_ngcontent-%COMP%]{display:flex;flex-direction:column;align-items:center;justify-content:center;height:100vh;padding:20px}.header[_ngcontent-%COMP%]{text-align:center;margin-bottom:20px}.header[_ngcontent-%COMP%]   h1[_ngcontent-%COMP%]{margin:0;color:#333}#username[_ngcontent-%COMP%]{color:#8e2de2}.admin-panel[_ngcontent-%COMP%]{background-color:#add8e6cc;border-radius:10px;width:300px;padding:20px;box-shadow:0 4px 8px #0003}.admin-panel[_ngcontent-%COMP%]   ul[_ngcontent-%COMP%]{list-style:none;padding:0;margin:0}.admin-panel[_ngcontent-%COMP%]   li[_ngcontent-%COMP%]{padding:10px;border-bottom:1px solid #ddd;display:flex;align-items:center;font-size:16px}.admin-panel[_ngcontent-%COMP%]   li[_ngcontent-%COMP%]   i[_ngcontent-%COMP%]{margin-right:10px;color:#8e2de2}.admin-panel[_ngcontent-%COMP%]   li[_ngcontent-%COMP%]:last-child{border-bottom:none}.scrolling-text[_ngcontent-%COMP%]{position:fixed;bottom:0;left:0;width:100%;background:#ffffffe6;color:#333;padding:10px;box-shadow:0 -2px 5px #0000001a;overflow:hidden}.scrolling-text[_ngcontent-%COMP%]   p[_ngcontent-%COMP%]{margin:0;white-space:nowrap;animation:_ngcontent-%COMP%_scroll 15s linear infinite}@keyframes _ngcontent-%COMP%_scroll{0%{transform:translate(100%)}to{transform:translate(-100%)}}","body[_ngcontent-%COMP%] {\n            font-family: Arial, sans-serif;\n            margin: 0;\n            padding: 0;\n            background-color: #87CEFA; \n\n            position: relative;\n            overflow: hidden;\n        }\n\n        .dashboard-container[_ngcontent-%COMP%] {\n            position: relative;\n            background-color: rgba(173, 216, 230, 0.8); \n\n            padding: 2rem;\n            border-radius: 10px;\n            max-width: 800px;\n            width: 100%;\n            margin: 2rem auto;\n            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);\n        }\n\n        .dashboard-header[_ngcontent-%COMP%] {\n            text-align: center;\n            margin-bottom: 1rem;\n        }\n\n        .dashboard-header[_ngcontent-%COMP%]   h1[_ngcontent-%COMP%] {\n            margin: 0;\n        }\n\n        .dashboard-header[_ngcontent-%COMP%]   .user-name[_ngcontent-%COMP%] {\n            font-size: 1.2rem;\n            font-weight: bold;\n            color: #333;\n        }\n\n        .dashboard-menu[_ngcontent-%COMP%] {\n            display: flex;\n            flex-direction: column;\n            gap: 1rem;\n        }\n\n        .dashboard-menu[_ngcontent-%COMP%]   a[_ngcontent-%COMP%] {\n            display: flex;\n            align-items: center;\n            padding: 1rem;\n            background-color: #f0f8ff; \n\n            border-radius: 5px;\n            text-decoration: none;\n            color: #333;\n            font-size: 1rem;\n            transition: background-color 0.3s ease;\n        }\n\n        .dashboard-menu[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]:hover {\n            background-color: #e0f7fa; \n\n        }\n\n        .dashboard-menu[_ngcontent-%COMP%]   a[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n            margin-right: 0.5rem;\n            color: #007BFF; \n\n        }\n\n        .scrolling-text[_ngcontent-%COMP%] {\n            position: absolute;\n            bottom: 0;\n            left: 50%;\n            transform: translateX(-50%);\n            white-space: nowrap;\n            overflow: hidden;\n            animation: _ngcontent-%COMP%_scroll-text 10s linear infinite;\n            font-size: 1rem;\n            color: #333;\n        }\n\n        @keyframes _ngcontent-%COMP%_scroll-text {\n            0% {\n                transform: translateX(100%);\n            }\n            100% {\n                transform: translateX(-100%);\n            }\n        }\n\n        .icons[_ngcontent-%COMP%] {\n            position: absolute;\n            top: 20px;\n            right: 20px;\n            display: flex;\n            gap: 10px;\n        }\n\n        .icons[_ngcontent-%COMP%]   i[_ngcontent-%COMP%] {\n            font-size: 1.5rem;\n            color: #007BFF;\n            opacity: 0;\n            transition: opacity 0.5s ease;\n        }\n\n        .icons[_ngcontent-%COMP%]:hover   i[_ngcontent-%COMP%] {\n            opacity: 1;\n        }"]}),s})()}}]);