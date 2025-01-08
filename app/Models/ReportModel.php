<?php namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = 'candidates'; // Default table, bisa disesuaikan

    // 1. Distribusi Kandidat per Jurusan
    public function getCandidatesPerProgram()
    {
        return $this->select('programs.name as program_name, COUNT(candidates.id) as total_candidates')
                    ->join('programs', 'candidates.program_id = programs.id')
                    ->groupBy('programs.name')
                    ->findAll();
    }

    // 2. Partisipasi Pemilih per Kelas
    public function getVotersPerGrade()
    {
        return $this->select('grades.name as grade_name, COUNT(voters.id) as total_voters')
                    ->join('grades', 'voters.grade_id = grades.id')
                    ->groupBy('grades.name')
                    ->findAll();
    }

    // 3. Hasil Pemilihan per Kandidat
    public function getVotesPerCandidate()
    {
        return $this->select('candidates.name as candidate_name, COUNT(votes.id) as total_votes')
                    ->join('candidates', 'votes.candidate_id = candidates.id')
                    ->groupBy('candidates.name')
                    ->findAll();
    }

    // 4. Aktivitas Admin


    // 5. Persentase Partisipasi Pemilih
    public function getParticipationRate()
    {
        $totalVoters = $this->db->table('voters')->countAll();
        $totalParticipants = $this->distinct()->select('voter_id')->countAllResults('votes');
        $participationRate = ($totalParticipants / $totalVoters) * 100;

        return [
            'total_voters' => $totalVoters,
            'total_participants' => $totalParticipants,
            'participation_rate' => $participationRate
        ];
    }

    // 6. Kinerja Kandidat per Jurusan
    public function getCandidatePerformancePerProgram()
    {
        return $this->select('programs.name as program_name, candidates.name as candidate_name, COUNT(votes.id) as total_votes')
                    ->join('candidates', 'votes.candidate_id = candidates.id')
                    ->join('programs', 'candidates.program_id = programs.id')
                    ->groupBy(['programs.name', 'candidates.name'])
                    ->findAll();
    }

    // 7. Perbandingan Kelas dan Jurusan
    public function getComparisonBetweenGradesAndPrograms()
    {
        return $this->select('grades.name as grade_name, programs.name as program_name, COUNT(voters.id) as total_voters')
                    ->join('grades', 'voters.grade_id = grades.id')
                    ->join('programs', 'voters.program_id = programs.id')
                    ->groupBy(['grades.name', 'programs.name'])
                    ->findAll();
    }
}
