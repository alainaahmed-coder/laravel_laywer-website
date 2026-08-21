/* LegalEase — shared placeholder data (Vanilla JS) */

const CITIES = ["Karachi", "Lahore", "Islamabad", "Rawalpindi", "Faisalabad", "Peshawar", "Multan", "Quetta"];

const SPECIALIZATIONS = [
  "Criminal Law",
  "Divorce & Family",
  "Affidavit",
  "Civil Law",
  "Corporate"
];

const LAWYERS = [
  { id: 1, name: "Adv. Hina Rasheed", spec: "Divorce & Family", city: "Lahore", exp: 12, fee: 4500, rating: 4.9, reviews: 128, img: "https://i.pravatar.cc/240?img=47", verified: true,
    bio: "Family law specialist handling khula, custody and maintenance matters with an empathetic, outcome-driven approach. Represented 600+ clients before family courts across Punjab.",
    quals: ["LL.M Family Law — Punjab University", "Bar Council ID: PB-45892", "Member, Lahore High Court Bar"],
    address: "Suite 402, Alfalah Chambers, Mall Road, Lahore" },
  { id: 2, name: "Adv. Bilal Ahmed Khan", spec: "Criminal Law", city: "Karachi", exp: 16, fee: 7000, rating: 4.8, reviews: 214, img: "https://i.pravatar.cc/240?img=12", verified: true,
    bio: "Criminal defence counsel with extensive trial experience in bail, narcotics and white-collar prosecution matters before Sessions and High Courts.",
    quals: ["LL.B — Karachi University", "Bar Council ID: SD-11204", "Sindh High Court Advocate"],
    address: "3rd Floor, Justice Plaza, Saddar, Karachi" },
  { id: 3, name: "Adv. Sara Malik", spec: "Corporate", city: "Islamabad", exp: 9, fee: 9000, rating: 4.7, reviews: 86, img: "https://i.pravatar.cc/240?img=32", verified: true,
    bio: "Corporate and commercial advisor for startups and SMEs: incorporation, SECP compliance, shareholder agreements and contract drafting.",
    quals: ["LL.M Corporate Law — LUMS", "Bar Council ID: IB-77310", "Certified Corporate Secretary"],
    address: "Office 12, Blue Area Business Centre, Islamabad" },
  { id: 4, name: "Adv. Usman Tariq", spec: "Civil Law", city: "Rawalpindi", exp: 7, fee: 3500, rating: 4.5, reviews: 64, img: "https://i.pravatar.cc/240?img=15", verified: true,
    bio: "Civil litigation practitioner focused on property disputes, inheritance partition and landlord-tenant cases.",
    quals: ["LL.B — International Islamic University", "Bar Council ID: PB-63118"],
    address: "Kacheri Road, Near District Courts, Rawalpindi" },
  { id: 5, name: "Adv. Ayesha Noor", spec: "Affidavit", city: "Faisalabad", exp: 5, fee: 1500, rating: 4.6, reviews: 51, img: "https://i.pravatar.cc/240?img=45", verified: false,
    bio: "Fast documentation services: affidavits, notarised declarations, name change and general power of attorney with same-day turnaround.",
    quals: ["LL.B — GC University Faisalabad", "Bar Council ID: PB-90455", "Notary Public"],
    address: "Shop 8, District Court Complex, Faisalabad" },
  { id: 6, name: "Adv. Kamran Sheikh", spec: "Criminal Law", city: "Islamabad", exp: 21, fee: 12000, rating: 5.0, reviews: 302, img: "https://i.pravatar.cc/240?img=52", verified: true,
    bio: "Senior counsel with two decades of appellate practice, including constitutional petitions and high-profile criminal appeals.",
    quals: ["LL.M — University of London", "Bar Council ID: IB-20017", "Supreme Court Advocate"],
    address: "Sector F-8 Markaz, Islamabad" },
  { id: 7, name: "Adv. Mehwish Iqbal", spec: "Divorce & Family", city: "Karachi", exp: 8, fee: 5000, rating: 4.4, reviews: 73, img: "https://i.pravatar.cc/240?img=26", verified: true,
    bio: "Handles guardianship, dowry recovery and cross-border family matters with strong mediation-first practice.",
    quals: ["LL.B — SZABIST", "Bar Council ID: SD-55821"],
    address: "Clifton Block 5, Karachi" },
  { id: 8, name: "Adv. Fahad Rehman", spec: "Civil Law", city: "Multan", exp: 11, fee: 2800, rating: 4.3, reviews: 39, img: "https://i.pravatar.cc/240?img=59", verified: false,
    bio: "Civil and revenue matters, land record corrections and specific performance suits in South Punjab.",
    quals: ["LL.B — Bahauddin Zakariya University", "Bar Council ID: PB-31220"],
    address: "Hussain Agahi Road, Multan" },
  { id: 9, name: "Adv. Zoya Hameed", spec: "Corporate", city: "Lahore", exp: 14, fee: 8500, rating: 4.8, reviews: 141, img: "https://i.pravatar.cc/240?img=20", verified: true,
    bio: "Advises multinationals on employment contracts, tax structuring and commercial arbitration.",
    quals: ["LL.M Commercial Law — Warwick", "Bar Council ID: PB-10093"],
    address: "Gulberg III, Lahore" }
];

const REVIEWS = [
  { name: "Hamza Yousaf", when: "2 weeks ago", rating: 5, text: "Extremely professional and responsive. Explained every step of my case in plain language and the hearing went exactly as advised." },
  { name: "Nadia Sultan", when: "1 month ago", rating: 5, text: "Booking a slot took two minutes and the consultation was punctual. Highly recommended for family matters." },
  { name: "Imran Qureshi", when: "3 months ago", rating: 4, text: "Very knowledgeable counsel. Fee is on the higher side but the documentation work was flawless." }
];

const TIME_SLOTS = {
  morning: ["09:00 AM", "09:45 AM", "10:30 AM", "11:15 AM", "12:00 PM"],
  evening: ["03:00 PM", "03:45 PM", "04:30 PM", "05:15 PM", "06:00 PM", "07:00 PM"]
};

const APPOINTMENTS = [
  { id: "APT-1041", client: "Hamza Yousaf", lawyer: "Adv. Bilal Ahmed Khan", spec: "Criminal Law", date: "2026-08-24", time: "10:30 AM", mode: "Office Visit", fee: 7000, status: "Approved" },
  { id: "APT-1040", client: "Nadia Sultan", lawyer: "Adv. Hina Rasheed", spec: "Divorce & Family", date: "2026-08-25", time: "04:30 PM", mode: "Video Call", fee: 4500, status: "Pending" },
  { id: "APT-1039", client: "Imran Qureshi", lawyer: "Adv. Sara Malik", spec: "Corporate", date: "2026-08-18", time: "12:00 PM", mode: "Office Visit", fee: 9000, status: "Completed" },
  { id: "APT-1038", client: "Rabia Aslam", lawyer: "Adv. Ayesha Noor", spec: "Affidavit", date: "2026-08-15", time: "09:45 AM", mode: "Phone Call", fee: 1500, status: "Completed" },
  { id: "APT-1037", client: "Owais Sheikh", lawyer: "Adv. Usman Tariq", spec: "Civil Law", date: "2026-08-12", time: "05:15 PM", mode: "Office Visit", fee: 3500, status: "Cancelled" }
];
